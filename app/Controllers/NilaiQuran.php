<?php

namespace App\Controllers;

use App\Models\Master\Msantri;
use App\Models\Master\MtahunAkademik;
use App\Models\Mkelas;
use App\Models\Mnilaitahsin;
use CodeIgniter\RESTful\ResourceController;

class NilaiQuran extends ResourceController
{
    protected $modelName = 'App\Models\Mnilaiquran';
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
        // $this->jadwal = new Mjadwal();
        $this->data['tahun_akademik'] = $this->thnAkademik->orderBy('tahun_akademik', 'desc')->limit(7)->findAll();
        $this->data['menu'] = 'Nilai Al Qur\'an';
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_penilaian' => 'active', 'submenu_quran' => 'active']);
    }

    public function index()
    {
        return view('nilaiQuran/index', $this->data);
    }

    public function detail($id_kelas)
    {
        $this->data['content'] = $this->kelas->find($id_kelas);
        $this->data['id_kelas'] = $id_kelas;
        return view('nilaiQuran/detail', $this->data);
    }

    public function add($id_kelas, $id_santri)
    {
        $curl = curl_init();
        $response = [];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://equran.id/api/v2/surat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "Content-Type: application/json",
                "Host: equran.id"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $response = $err;
        } else {
            $response = json_decode($response, true);
        }
        $return = [
            'santri'  => $this->santri->find($id_santri),
            'id_kelas' => $id_kelas,
            'content' => $response
        ];
        return json_encode($return);
    }

    public function addNilaiTahsin($id_kelas, $id_santri)
    {
        $this->data['content'] = $this->kelas->select('semester, fashohah, tajwid, kelancaran, nt.id as id_nilai_tahsin, kelas.id as id_kelas, s.id as id_santri')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('nilai_tahsin nt', 'kelas.id = nt.id_kelas and s.id = nt.id_santri', 'left')->where(['kelas.id' =>  $id_kelas, 's.id' => $id_santri])->first();
        return view('nilaiQuran/addTahsin', $this->data);
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
        if (!empty($filter['tahunAjaran'])) {
            $data = $this->kelas->where(['kelas.tahun_ajaran' => $filter['tahunAjaran']]);
        }
        if (!empty($filter['semester'])) {
            $data = $this->kelas->where(['kelas.semester' => $filter['semester']]);
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

    public function getDataDetail($id_kelas)
    {
        $param = $this->request->getPost();
        $data = $this->kelas->select('nis, fullname, ks.id_santri, count(nq.id) as count_nilai')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('nilai_quran nq', 'kelas.id = nq.id_kelas and s.id = nq.id_santri', 'left')
            ->where(['kelas.id' => $id_kelas])->orderBy('fullname ')->groupBy('s.id');
        if (!empty($param['search']['value'])) {
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('fullname', $searchValue)
                ->groupEnd();
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

    public function detailSantri($id_kelas, $id_santri)
    {
        $this->data['tahsin'] = $this->kelas->select('semester, fashohah, tajwid, kelancaran')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('nilai_tahsin nt', 'kelas.id = nt.id_kelas and s.id = nt.id_santri', 'left')->where(['kelas.id' =>  $id_kelas, 's.id' => $id_santri])->first();
        return view('nilaiQuran/detailNilai', $this->data);
    }

    public function getNilaiSantri()
    {
        $param = $this->request->getPost();
        $data = $this->kelas->select('nis, fullname, ks.id_santri, surat, halaman, ayat, nilai, nq.id')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('nilai_quran nq', 'kelas.id = nq.id_kelas and s.id = nq.id_santri')
            ->orderBy('nq.nomor_surat ')->groupBy('nq.id');
        if (!empty($param['semester'])) {
            $data = $data->where('kelas.semester',  $param['semester']);
        }
        if (!empty($param['id_kelas'])) {
            $data = $data->where('kelas.id', $param['id_kelas']);
        }
        if (!empty($param['id_santri'])) {
            $data = $data->where('s.id',  $param['id_santri']);
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

    public function getTahsin()
    {
        $param = $this->request->getPost();
        $data = $this->kelas->select('id_santri, semester, fashohah, kelancaran, tajwid')
            ->join('nilai_tahsin nt', 'nt.id_kelas = kelas.id')
            ->where(['kelas.semester' => $param['semester'], 'nt.id_santri' => $param['id_santri']]);
        $filtered = $data->countAllResults(false);
        $datas = $data->first();
        $thsn[] = [
            'id_santri'    => $datas['id_santri'] ?? '-',
            'semester'    => $datas['semester'] ?? '-',
            'jenis'    => 'fashohah',
            'nilai'     => $datas['fashohah'] ?? '-',
        ];
        $thsn[] = [
            'id_santri'    => $datas['id_santri'] ?? '-',
            'semester'    => $datas['semester'] ?? '-',
            'jenis'    => 'tajwid',
            'nilai'     => $datas['tajwid'] ?? '-',
        ];
        $thsn[] = [
            'id_santri'    => $datas['id_santri'] ?? '-',
            'semester'    => $datas['semester'] ?? '-',
            'jenis'    => 'kelancaran',
            'nilai'     => $datas['kelancaran'] ?? '-',
        ];
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "data" => $thsn
        );
        return $this->respond($return);
    }

    public function process()
    {
        $form = $this->request->getPost('form');
        for ($i = 0; $i < count($form['surat']); $i++) {
            $data[] = [
                'id_kelas' => $form['id_kelas'],
                'id_santri' => $form['id_santri'],
                'surat' => explode('#', $form['surat'][$i])[1],
                'nomor_surat' => explode('#', $form['surat'][$i])[0],
                'ayat' => $form['ayat'][$i],
                'halaman' => $form['halaman'][$i],
                'nilai' => $form['nilai'][$i]
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
        return json_encode($return);
    }

    public function processTahsin()
    {
        $form = $this->request->getPost('form');
        $mtahsin = new Mnilaitahsin();
        try {
            $mtahsin->save($form);
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

    public function deleteNilai($id = null)
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
