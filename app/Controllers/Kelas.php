<?php

namespace App\Controllers;

use App\Models\Master\Msantri;
use App\Models\Master\Mustadz;
use App\Models\Mkelassantri;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Kelas extends ResourceController
{
    protected $modelName = 'App\Models\Mkelas';
    protected $format    = 'json';
    protected $ustadz;

    public function __construct()
    {
        $this->ustadz = new Mustadz();
        $this->data['menu'] = 'Master data kelas';
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_master' => 'active', 'submenu_kelas' => 'active']);
    }

    public function index()
    {
        return view('kelas/index', $this->data);
    }

    public function getData()
    {
        $param = $this->request->getPost();
        $data = $this->model->select('kelas.*, u.fullname, count(ks.id) as total_santri')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left')->join('kelas_santri ks', 'kelas.id = ks.id_kelas', 'left')->groupBy('kelas.id')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('tahun_ajaran, semester, nama_kelas', 'asc');
        if (!empty($param['search']['value'])) {
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('nama_kelas', $searchValue)
                ->orLike('fullname', $searchValue)
                ->orLike('tahun_ajaran', $searchValue)
                ->groupEnd();
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->model->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->model->countAllResults(),
            "data" => $datas
        );
        return isset($param['api']) ? $this->respond($return) : json_encode($return);
    }

    public function add()
    {
        $this->data['ustadz'] = $this->ustadz->findAll();
        return view('kelas/add', $this->data);
    }

    public function edit($id = null)
    {
        $this->data['content'] = $this->model->where(['id' => $id])->first();
        $this->data['ustadz'] = $this->ustadz->findAll();
        return view('kelas/edit', $this->data);
    }

    public function process()
    {
        $data = $this->request->getPost('form');
        try {
            $this->model->save($data);
            $return = [
                'status'    => 1,
                'title'     => 'Berhasil',
                'message'   => 'Data berhasil disimpan'
            ];
        } catch (\Exception $er) {
            $return = [
                'status'    => 0,
                'title'     => 'Error',
                'message'   => $er->getMessage()
            ];
        }
        return json_encode($return);
    }

    public function detail($id = null): string
    {
        $this->data['content'] = $this->model->select('kelas.*, u.fullname')->join('ustadz u', 'u.id = kelas.id_ustadz')->where(['kelas.id' => $id])->first();
        return view('kelas/detail', $this->data);
    }

    public function detailData($id = null)
    {
        $param = $this->request->getPost();
        $data = $this->model->select('kelas.*, u.fullname as nama_ustadz, s.fullname as nama_santri, s.nis, s.id as id_santri')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left')->join('kelas_santri ks', 'kelas.id = ks.id_kelas', 'left')->join('santri s', 'ks.id_santri = s.id')->where(['kelas.id' => $id])->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('tahun_ajaran, semester, nama_kelas', 'asc');
        if (!empty($param['search']['value'])) {
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('nis', $searchValue)
                ->orLike('s.fullname', $searchValue)
                ->groupEnd();
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->model->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->model->countAllResults(),
            "data" => $datas
        );
        return isset($param['api']) ? $this->respond($return) : json_encode($return);
    }

    public function addSantri($idKelas = null)
    {
        $santri = new Msantri();
        $this->data['santri'] = $santri->findAll();
        $this->data['id_kelas'] = $idKelas;
        return view('kelas/addSantri', $this->data);
    }

    public function processAddSantri()
    {
        $form = $this->request->getPost('form');
        $kelas = new Mkelassantri();
        foreach ($form['id_santri'] as $key) {
            $data[] = [
                'id_santri' => $key,
                'id_kelas'  => $form['id_kelas']
            ];
        }
        try {
            $kelas->insertBatch($data);
            $return = [
                'status' => 1,
                'title'  => 'Berhasil',
                'message' => 'Data berhasil disimpan'
            ];
        } catch (\Exception $er) {
            $return = [
                'status' => 0,
                'title'  => 'Gagal',
                'message' => $er->getMessage()
            ];
        }
        return json_encode($return);
    }

    public function deleteSantri($id_kelas, $id_santri)
    {
        $kelas = new Mkelassantri();
        try {
            $kelas->where(['id_kelas' => $id_kelas, 'id_santri' => $id_santri])->delete();
            $return = [
                'status' => 1,
                'title'  => 'Berhasil',
                'message' => 'Data berhasil dihapus'
            ];
        } catch (\Exception $er) {
            $return = [
                'status' => 0,
                'title'  => 'Gagal',
                'message' => $er->getMessage()
            ];
        }
        return json_encode($return);
    }

    public function delete($id = null): string
    {
        try {
            $this->model->delete($id);
            $return = [
                'status' => 1,
                'title'  => 'Berhasil',
                'message' => 'Data berhasil dihapus'
            ];
        } catch (\Exception $er) {
            $return = [
                'status' => 0,
                'title'  => 'Gagal',
                'message' => $er->getMessage()
            ];
        }
        return json_encode($return);
    }
}
