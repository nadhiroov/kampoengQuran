<?php

namespace App\Controllers;

use App\Models\Master\Msubmateri;
use App\Models\Master\Mustadz;
use App\Models\Mkelas;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Jadwal extends ResourceController
{
    protected $modelName = 'App\Models\Mjadwal';
    protected $format    = 'json';
    protected $mKelas;

    public function __construct()
    {
        $this->mKelas = new Mkelas();
    }
    
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    public function getData()
    {
        $param = $this->request->getPost();
        $data = $this->mKelas->select('j.*, kelas.nama_kelas, u.fullname as nama_ustadz')->join('jadwal j', 'kelas.id = j.id_kelas')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left')->groupBy('j.id');
        if (!empty($param['search']['value'])) {
            $data = $this->mKelas->like('hari', $param['search']['value']);
            $data = $this->mKelas->orLike('jam_awal', $param['search']['value']);
            $data = $this->mKelas->orLike('jam_akhir', $param['search']['value']);
            $data = $this->mKelas->orLike('lokasi', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->mKelas->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->mKelas->countAllResults(),

            "data" => $datas
        );
        return isset($param['api']) ? $this->respond($return) : json_encode($return);
    }
    
    public function add($idKelas = null)
    {
        $ustadz = new Mustadz();
        $submateri = new Msubmateri();
        $this->data['ustadz'] = $ustadz->findAll();
        $this->data['submateri'] = $submateri->findAll();
        $this->data['idKelas'] = $idKelas;
        return view('jadwal/add', $this->data);
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
        try {
            $this->model->delete($id);
            $return = [
                'status' => 1,
                'title'  => 'Berhasil',
                'message' => 'Berhasil menghapus data'
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
