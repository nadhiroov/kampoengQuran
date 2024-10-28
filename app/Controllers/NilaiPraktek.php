<?php

namespace App\Controllers;

use App\Models\Master\Msantri;
use App\Models\Mjadwal;
use App\Models\Mkelas;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class NilaiPraktek extends ResourceController
{
    protected $modelName = 'App\Models\MnilaiPraktek';
    protected $format    = 'json';
    protected $kelas;
    protected $santri;
    protected $jadwal;

    public function __construct()
    {
        $this->kelas = new Mkelas();
        $this->santri = new Msantri();
        $this->jadwal = new Mjadwal();
        $this->data['menu'] = 'Nilai praktek kelas';
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_penilaian' => 'active', 'submenu_nilai_praktek' => 'active']);
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return view('nilaiPraktek/index', $this->data);
    }

    public function detail($id_kelas)
    {
        $this->data['content'] = $this->kelas->where(['id' => $id_kelas])->first();
        return view('nilaiPraktek/detail', $this->data);
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
                ->orLike('fullname', $searchValue)
                ->orLike('tahun_ajaran', $searchValue)
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
        $data = $this->jadwal->select('jadwal.id, jadwal.id_kelas, materi, jadwal.id_materi ,fullname, praktek, p.id as id_praktek')->join('materi m', 'm.id = jadwal.id_materi', 'left')->join('praktek p', 'm.id = p.id_materi')->join('ustadz u', 'u.id = jadwal.id_ustadz', 'left')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->groupBy('p.id');
        if (!empty($param['search']['value'])) {
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('materi', $searchValue)
                ->orLike('fullname', $searchValue)
                ->groupEnd();
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $data->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        if ($id_kelas != '') {
            $data = $data->where(['jadwal.id_kelas' => $id_kelas]);
        }
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

    public function listPenilaian($id_kelas, $id_praktek)
    {
        $nilai = $this->kelas->select('nama_kelas, fullname, materi, nilai, deskripsi, nilai_keterampilan, deskripsi_keterampilan,ks.id_santri, np.id as id_nilai, p.id as id_praktek, kelas.id, praktek')
            ->join('kelas_santri ks', 'kelas.id = ks.id_kelas')
            ->join('jadwal j', "kelas.id = j.id_kelas", 'left')
            ->join('materi m', "m.id = j.id_materi and m.deleted_at is null", 'left')
            ->join('praktek p', 'm.id  = p.id_materi')
            ->join('nilai_praktek np', "kelas.id = np.id_kelas and ks.id_santri = np.id_santri and p.id = np.id_praktek", 'left')
            ->join('santri s', 's.id = ks.id_santri')
            ->where(['kelas.id' => $id_kelas, 'p.id' => $id_praktek])->orderBy('fullname')->groupBy('s.id')->find();
        $this->data['nilai'] = $nilai;
        $this->data['id_kelas'] = $id_kelas;
        return view('nilaiPraktek/penilaian', $this->data);
    }

    public function process()
    {
        $form = $this->request->getPost('form');
        $insert = true;
        for ($i = 0; $i < count($form['id_santri']); $i++) {
            $data[] = [
                'id_santri' => $form['id_santri'][$i],
                'id_kelas'  => $form['id_kelas'],
                'id_praktek' => $form['id_praktek'],
                'nilai'     => $form['nilai'][$i],
                'deskripsi' => $form['deskripsi'][$i],
                'nilai_keterampilan'     => $form['nilai_keterampilan'][$i],
                'deskripsi_keterampilan' => $form['deskripsi_keterampilan'][$i],
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

    public function getNilaiPraktek()
    {
        $param = $this->request->getPost();
        $data = $this->santri->select('fullname, materi, praktek, nilai as nilai_pengetahuan, deskripsi as deskripsi_pengetahuan, nilai_keterampilan, deskripsi_keterampilan, ks.id_santri, ks.id_kelas, n.id as id_nilai_praktek')
            ->join('kelas_santri ks', 'santri.id = ks.id_santri')
            ->join('kelas k', 'k.id = ks.id_kelas and k.deleted_at is null')
            ->join('jadwal j', 'k.id = j.id_kelas')
            ->join('materi m', 'm.id = j.id_materi and m.deleted_at is null')
            ->join('praktek p', 'm.id = p.id_materi')
            ->join('nilai_praktek n', 'p.id = n.id_praktek and k.id = n.id_kelas and santri.id = n.id_santri', 'left')
            ->where(['m.semester' => $param['semester'], 'ks.id_santri' => $param['id_santri']])
            ->groupBy('p.id');
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
}
