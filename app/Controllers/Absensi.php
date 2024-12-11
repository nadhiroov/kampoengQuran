<?php

namespace App\Controllers;

use App\Models\Master\Msantri;
use App\Models\Master\MtahunAkademik;
use App\Models\Mkelas;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Absensi extends ResourceController
{
    protected $modelName = 'App\Models\Mabsensi';
    protected $format    = 'json';
    protected $kelas;
    protected $santri;
    protected $jadwal;
    protected $thnAkademik;

    public function __construct()
    {
        $this->kelas = new Mkelas();
        $this->santri = new Msantri();
        $this->thnAkademik = new MtahunAkademik();
        $this->data['tahun_akademik'] = $this->thnAkademik->orderBy('tahun_akademik', 'desc')->limit(7)->findAll();
        $this->data['menu'] = 'Absensi';
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_penilaian' => 'active', 'submenu_nilai_absensi' => 'active']);
    }

    public function index()
    {
        return view('absensi/index', $this->data);
    }

    public function detail($id_kelas)
    {
        $absensi = $this->kelas->select('nama_kelas, fullname, sakit, izin, tanpa_keterangan, catatan, ks.id_santri, a.id as id_absensi')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('absensi a', 'kelas.id = a.id_kelas and s.id = a.id_santri', 'left')
            ->where(['kelas.id' => $id_kelas])->orderBy('fullname ')->find();
        $this->data['id_kelas'] = $id_kelas;
        $this->data['absensi'] = $absensi;
        $this->data['content'] = $this->kelas->where(['id' => $id_kelas])->first();
        return view('absensi/detail', $this->data);
    }

    public function getData()
    {
        $param = $this->request->getPost();
        $filter = $this->request->getPost('filter');
        $data = $this->kelas->select('kelas.*, u.fullname')->join('ustadz u', 'u.id = kelas.id_ustadz', 'left');
        if (!empty($param['id_santri'])) {
            $data = $this->kelas->join('kelas_santri  ks', 'kelas.id = ks.id_kelas');
            $data = $this->kelas->where(['ks.id_santri' => $param['id_santri']]);
        }
        $data = $this->kelas->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('tahun_ajaran, semester, nama_kelas', 'asc')->groupBy('kelas.id');
        if (!empty($param['search']['value'])) {
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('nama_kelas', $searchValue)
                ->orLike('semester', $searchValue)
                ->groupEnd();
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->kelas->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        if (!empty($filter['tahunAjaran'])) {
            $data = $data->where('kelas.tahun_ajaran', $filter['tahunAjaran']);
        }
        if (!empty($filter['semester'])) {
            $data = $data->where('kelas.semester', $filter['semester']);
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

    public function process()
    {
        $form = $this->request->getPost('form');
        $insert = true;
        for ($i = 0; $i < count($form['id_santri']); $i++) {
            $data[] = [
                'id_santri' => intval($form['id_santri'][$i]),
                'id_kelas'  => intval($form['id_kelas']),
                'sakit'     => intval($form['sakit'][$i]),
                'izin'      => intval($form['izin'][$i]),
                'tanpa_keterangan'  => intval($form['alpha'][$i]),
                'catatan'   => $form['catatan'][$i],
            ];
            if (isset($form['id_absensi'][$i])) {
                $data[$i]['id'] = $form['id_absensi'][$i];
                $insert = false;
            }
        }
        try {
            if ($insert) {
                $this->model->insertBatch($data);
            } else {
                $this->model->updateBatch($data, 'id');
            }
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
