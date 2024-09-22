<?php

namespace App\Controllers\Master;

use App\Models\Master\Msantri;
use App\Models\Master\Mustadz;
use App\Models\Mkelassantri;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Kelas extends ResourceController
{
    protected $modelName = 'App\Models\Master\Mkelas';
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
        return view('master/kelas/index', $this->data);
    }

    public function getData()
    {
        $param = $this->request->getPost();
        $data = $this->model->select('kelas.*, u.fullname, count(ks.id) as total_santri')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left')->join('kelas_santri ks', 'kelas.id = ks.id_kelas', 'left')->groupBy('kelas.id')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('tahun_ajaran, semester, nama_kelas', 'asc');
        if (!empty($param['search']['value'])) {
            $data = $this->model->like('nama_kelas', $param['search']['value']);
            $data = $this->model->orLike('fullname', $param['search']['value']);
            $data = $this->model->orLike('tahun_ajaran', $param['search']['value']);
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
        return view('master/kelas/add', $this->data);
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
        return view('master/kelas/detail', $this->data);
    }

    public function detailData($id = null)
    {
        $param = $this->request->getPost();
        $data = $this->model->select('kelas.*, u.fullname as nama_ustadz, s.fullname as nama_santri, s.nis, s.id as id_santri')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left')->join('kelas_santri ks', 'kelas.id = ks.id_kelas', 'left')->join('santri s', 'ks.id_santri = s.id')->where(['kelas.id' => $id])->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('tahun_ajaran, semester, nama_kelas', 'asc');
        if (!empty($param['search']['value'])) {
            $data = $this->model->like('nama_kelas', $param['search']['value']);
            $data = $this->model->orLike('fullname', $param['search']['value']);
            $data = $this->model->orLike('tahun_ajaran', $param['search']['value']);
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
        return view('master/kelas/addSantri', $this->data);
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

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
