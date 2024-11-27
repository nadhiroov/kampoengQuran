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
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('materi', $searchValue)
                ->orLike('fullname', $searchValue)
                ->groupEnd();
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

    public function listPenilaian($id_kelas, $id_materi)
    {
        $nilai = $this->kelas->select('nama_kelas, fullname, materi, nilai, ks.id_santri, n.id as id_nilai, kelas.id')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('jadwal j', "kelas.id = j.id_kelas", 'left')
            ->join('materi m', "m.id = j.id_materi and m.deleted_at is null", 'left')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('nilai n', "kelas.id = n.id_kelas and ks.id_santri = n.id_santri and m.id = n.id_materi", 'left')
            ->groupBy('s.id')
            ->where(['kelas.id' => $id_kelas, 'm.id' => $id_materi])->orderBy('fullname ')->find();
        $this->data['nilai'] = $nilai;
        $this->data['id_kelas'] = $id_kelas;
        $this->data['id_materi'] = $id_materi;

        return view('nilai/penilaian', $this->data);
    }

    public function process()
    {
        $form = $this->request->getPost('form');
        $insert = true;
        for ($i = 0; $i < count($form['id_santri']); $i++) {
            $data[] = [
                'id_santri' => $form['id_santri'][$i],
                'id_kelas'  => $form['id_kelas'],
                'id_materi'  => $form['id_materi'],
                'nilai' => $form['nilai'][$i],
            ];
            if (isset($form['id_nilai'][$i])) {
                $data[$i]['id'] = $form['id_nilai'][$i];
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

    public function getNilaiSantri()
    {
        $param = $this->request->getPost();
        $data = $this->kelas->select('nama_kelas, fullname, materi, nilai, ks.id_santri, n.id as id_nilai, kelas.id')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('jadwal j', "kelas.id = j.id_kelas", 'left')
            ->join('materi m', "m.id = j.id_materi and m.deleted_at is null", 'left')
            ->join('santri s', 's.id = ks.id_santri')
            ->join('nilai n', "kelas.id = n.id_kelas and ks.id_santri = n.id_santri and m.id = n.id_materi", 'left')
            ->where(['kelas.semester' => $param['semester'], 's.id' => $param['id_santri']])->groupBy('m.id');

        /* $data = $this->santri->select('fullname, materi, nilai, m.id as id_materi, ks.id_santri, ks.id_kelas, n.id as id_nilai')
            ->join('kelas_santri ks', 'santri.id = ks.id_santri')
            ->join('kelas k', 'k.id = ks.id_kelas and k.deleted_at is null')
            ->join('nilai n', 'ks.id_kelas = n.id_kelas', 'left')
            ->join('materi m', 'm.id = n.id_materi and m.deleted_at is null')
            // ->join('jadwal j', 'k.id = j.id_kelas')
            ->where(['k.semester' => $param['semester'], 'santri.id' => $param['id_santri']])
            ->groupBy('m.id'); */
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $data->countAllResults(),
            "data" => $datas
        );
        return isset($param['api']) ? $this->respond($return) : json_encode($return);
    }

    public function getReport($id_santri, $semester)
    {
        $santri = $this->santri->select('fullname, nama_kelas, tahun_ajaran, semester,')
            ->join('kelas_santri ks',  'santri.id = ks.id_santri')
            ->join('kelas k', 'ks.id_kelas = k.id')
            ->where(['santri.id' => $id_santri, 'semester' => $semester])->first();

        $tahfidz = $this->santri->select('surat, ayat, nilai')
            ->join('kelas_santri ks',  'santri.id = ks.id_santri')
            ->join('kelas k', 'ks.id_kelas = k.id')
            ->join('nilai_quran nq', 'k.id = nq.id_kelas and santri.id = nq.id_santri', 'left')
            ->orderBy('nq.nomor_surat')
            ->where(['santri.id' => $id_santri, 'semester' => $semester])->findAll();

        $tahsin = $this->santri->select('fashohah, tajwid, kelancaran')
            ->join('kelas_santri ks', 'santri.id = ks.id_santri')
            ->join('kelas k', 'ks.id_kelas = k.id')
            ->join('nilai_tahsin nt', 'k.id = nt.id_kelas and santri.id = nt.id_santri')
            ->where(['santri.id' => $id_santri, 'k.semester' => $semester])->first();


        $thsn[] = [
            'jenis'    => 'fashohah',
            'nilai'     => $tahsin['fashohah'] ?? '-',
        ];
        $thsn[] = [
            'jenis'    => 'tajwid',
            'nilai'     => $tahsin['tajwid'] ?? '-',
        ];
        $thsn[] = [
            'jenis'    => 'kelancaran',
            'nilai'     => $tahsin['kelancaran'] ?? '-',
        ];

        $materi = $this->santri->select('materi, nilai, k.id')
            ->join('kelas_santri ks', 'santri.id = ks.id_santri')
            ->join('kelas k', 'ks.id_kelas = k.id')
            ->join('jadwal j', 'k.id = j.id_kelas')
            ->join('materi m', 'j.id_materi = m.id and m.deleted_at is null')
            ->join('nilai n', 'k.id = n.id_kelas and santri.id = n.id_santri and m.id = n.id_materi', 'left')
            ->where(['santri.id' => $id_santri, 'k.semester' => $semester])->groupBy('m.id')->findAll();

        $praktek = $this->santri->select('praktek, nilai as nilai_pengetahuan, deskripsi as deskrippsi_pengetahuan, nilai_keterampilan, deskripsi_keterampilan')
            ->join('kelas_santri ks', 'santri.id = ks.id_santri')
            ->join('kelas k', 'ks.id_kelas = k.id')
            ->join('jadwal j', 'k.id = j.id_kelas')
            ->join('materi m', 'j.id_materi = m.id and m.deleted_at is null')
            ->join('praktek p', 'm.id = p.id_materi and p.deleted_at is null')
            ->join('nilai_praktek np', 'k.id = np.id_kelas and santri.id = np.id_santri and p.id = np.id_praktek', 'left')
            ->where(['santri.id' => $id_santri, 'k.semester' => $semester])->findAll();

        $absensi = $this->santri->select('sakit, izin, tanpa_keterangan, catatan')
            ->join('kelas_santri ks', 'santri.id = ks.id_santri')
            ->join('kelas k', 'ks.id_kelas = k.id')
            ->join('absensi a', 'k.id = a.id_kelas and santri.id = a.id_santri', 'left')
            ->where(['santri.id' => $id_santri, 'semester' => $semester])->first();

        $abs[] = [
            'jenis' => 'sakit',
            'jumlah' => $absensi['sakit'] ?? '-'
        ];
        $abs[] = [
            'jenis' => 'izin',
            'jumlah' => $absensi['izin'] ?? '-'
        ];
        $abs[] = [
            'jenis' => 'Tanpa Keterangan',
            'jumlah' => $absensi['tanpa_keterangan'] ?? '-'
        ];
        // $ctt[] = [
        //     'jenis' => 'catatan',
        //     'isi' => $absensi['catatan'] ?? '-'
        // ];

        $return = [
            'santri'   => [$santri],
            'tahfidz'  => $tahfidz,
            'tahsin'   => $thsn,
            'materi'   => $materi,
            'praktek'  => $praktek,
            'absensi'  => $abs,
            'catatan'  => $absensi['catatan'] ?? '-'

        ];
        return $this->respond($return);
    }
}
