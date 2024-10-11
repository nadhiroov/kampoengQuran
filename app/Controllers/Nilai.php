<?php

namespace App\Controllers;

use App\Models\Master\Msantri;
use App\Models\Mjadwal;
use App\Models\Mkelas;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Nilai extends ResourceController
{
    protected $modelName = 'App\Models\Mnilai';
    protected $format    = 'json';
    protected $kelas;
    protected $santri;
    protected $jadwal;

    public function __construct()
    {
        $this->kelas = new Mkelas();
        $this->santri = new Msantri();
        $this->jadwal = new Mjadwal();
        $this->data['menu'] = 'Nilai kelas';
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_penilaian' => 'active', 'submenu_nilai_materi' => 'active']);
    }

    public function index()
    {
        return view('nilai/index', $this->data);
    }

    public function detail($id_kelas)
    {
        $this->data['content'] = $this->kelas->where(['id' => $id_kelas])->first();
        return view('nilai/detail', $this->data);
    }

    public function getData()
    {
        $param = $this->request->getPost();
        $data = $this->kelas->select('kelas.*, u.fullname')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('tahun_ajaran, semester, nama_kelas', 'asc');
        if (!empty($param['search']['value'])) {
            $data = $this->kelas->like('nama_kelas', $param['search']['value']);
            $data = $this->kelas->orLike('fullname', $param['search']['value']);
            $data = $this->kelas->orLike('tahun_ajaran', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->kelas->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->kelas->countAllResults(),
            "data" => $datas
        );
        return isset($param['api']) ? $this->respond($return) : json_encode($return);
    }

    public function getDataDetail($id_kelas = '')
    {
        $param = $this->request->getPost();
        $data = $this->jadwal->select('jadwal.id, jadwal.id_kelas, materi, jadwal.id_materi ,fullname')->join('materi m', 'm.id = jadwal.id_materi', 'left')->join('ustadz u', 'u.id = jadwal.id_ustadz', 'left')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->groupBy('m.id');
        if (!empty($param['search']['value'])) {
            $data = $this->jadwal->like('materi', $param['search']['value']);
            $data = $this->jadwal->orLikelike('fullname', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->jadwal->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        if ($id_kelas != '') {
            $data = $this->jadwal->where(['jadwal.id_kelas' => $id_kelas]);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->jadwal->countAllResults(),
            "data" => $datas
        );
        return isset($param['api']) ? $this->respond($return) : json_encode($return);
    }

    public function listPenilaian($id_kelas, $id_materi) {
        $data = $this->kelas->select('nama_kelas, fullname, materi, nama_kelas, nilai, ks.id_santri')
                            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
                            ->join('jadwal j', "kelas.id = j.id_kelas", 'left')
                            ->join('materi m', "m.id = j.id_materi", 'left')
                            ->join('nilai n', "kelas.id = n.id_kelas and ks.id_santri = n.id_santri and m.id = n.id_materi", 'left')
                            ->join('santri s', 's.id = ks.id_santri')
                            ->where(['kelas.id' => $id_kelas, 'm.id' => $id_materi])->orderBy('fullname ');
        $this->data['content'] = $data->find();
        $this->data['id_kelas'] = $id_kelas;
        $this->data['id_materi'] = $id_materi;
        return view('nilai/penilaian', $this->data);
    }

    public function process() {
        $form = $this->request->getPost('form');
        for ($i=0; $i < count($form['id_santri']); $i++) {
            $data[] = [
                'id_santri' => $form['id_santri'][$i],
                'id_kelas'  => $form['id_kelas'],
                'id_materi'  => $form['id_materi'],
                'nilai' => $form['nilai'][$i],
            ];
        }
        try {
            $this->model->insertBatch($data);
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
        dd($return);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
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
