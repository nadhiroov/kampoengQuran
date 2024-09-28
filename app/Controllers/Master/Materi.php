<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\Mmateri;
use App\Models\Master\MPraktek;
use App\Models\Master\Msubmateri;

class Materi extends BaseController
{
    protected $materi;
    protected $submateri;
    protected $praktek;

    public function __construct()
    {
        $this->materi = new Mmateri();
        $this->submateri = new Msubmateri();
        $this->praktek = new MPraktek();
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_master' => 'active', 'submenu_materi' => 'active']);
        $this->data['menu'] = 'Master data materi';
    }

    public function index()
    {
        return view('master/materi/index', $this->data);
    }

    public function getData(): string
    {
        $param = $this->request->getPost();
        $data = $this->materi->select('materi.*, count(s.id) as count_submateri')->join('submateri s', 'materi.id = s.id_materi', 'left')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('materi', 'asc')->groupBy('materi.id')->where('s.deleted_at is null');
        if (!empty($param['search']['value'])) {
            $data = $this->materi->like('materi', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->materi->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->materi->countAllResults(),
            "data" => $datas
        );
        return json_encode($return);
    }

    public function process(): string
    {
        $data = $this->request->getPost('form');
        try {
            $this->materi->save($data);
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

    public function edit($id = null): string
    {
        $this->data['content'] = $this->materi->where(['id' => $id])->first();
        return view('master/materi/edit', $this->data);
    }

    public function detail($id = null): string
    {
        $this->data['submenu'] = 'detail';
        $this->data['content'] = $this->materi->where(['id' => $id])->first();
        return view('master/materi/detail', $this->data);
    }

    public function getDataDetail($idMateri = null)
    {
        $param = $this->request->getPost();
        $data = $this->submateri->select('submateri.*, m.materi')->join('materi m', 'm.id = submateri.id_materi', 'left')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->where(['m.id' => $idMateri]);
        if (!empty($param['search']['value'])) {
            $data = $this->materi->like('materi', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->materi->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->materi->countAllResults(),
            "data" => $datas
        );
        return json_encode($return);
    }

    public function getDetailPraktek($idMateri = null)
    {
        $param = $this->request->getPost();
        $data = $this->praktek->select('praktek.*, m.materi')->join('materi m', 'm.id = praktek.id_materi', 'left')->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->where(['m.id' => $idMateri]);
        if (!empty($param['search']['value'])) {
            $data = $this->materi->like('materi', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->materi->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->materi->countAllResults(),
            "data" => $datas
        );
        return json_encode($return);
    }

    public function processSubmateri()
    {
        $data = $this->request->getPost('form');
        try {
            $this->submateri->save($data);
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

    public function addSubmateri($id = null)
    {
        $this->data['content']['id'] = $id;
        return view('master/materi/addSubmateri', $this->data);
    }

    public function editSubmateri($id = null)
    {
        $this->data['content'] = $this->submateri->where(['id' => $id])->first();
        return view('master/materi/editSubmateri', $this->data);
    }

    public function deleteSubmateri($id = null): string
    {
        try {
            $this->submateri->delete($id);
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

    public function addPraktek($id = null)
    {
        $this->data['content']['id'] = $id;
        return view('master/materi/addPraktek', $this->data);
    }

    public function editPraktek($id = null)
    {
        $this->data['content'] = $this->praktek->where(['id' => $id])->first();
        return view('master/materi/editPraktek', $this->data);
    }

    public function deletePraktek($id = null): string
    {
        try {
            $this->praktek->delete($id);
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

    public function processPraktek()
    {
        $data = $this->request->getPost('form');
        try {
            $this->praktek->save($data);
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
}
