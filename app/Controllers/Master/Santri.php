<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\Msantri;

class Santri extends BaseController
{
    public function __construct()
    {
        $this->model = new Msantri();
        $this->view = \Config\Services::renderer();
        $this->view->setData(['menu_master' => 'active', 'submenu_santri' => 'active']);
        $this->data['menu'] = 'Master data santri';
    }

    public function index()
    {
        return view('master/santri/index', $this->data);
    }

    public function getData(): string
    {
        $param = $this->request->getPost();
        $data = $this->model->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('angkatan, fullname', 'asc');
        if (!empty($param['search']['value'])) {
            $searchValue = $param['search']['value'];
            $data->groupStart()
                ->like('nis', $searchValue)
                ->orLike('fullname', $searchValue)
                ->orLike('email', $searchValue)
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
        return json_encode($return);
    }

    public function detail($id = null): string
    {
        $this->data['submenu'] = 'detail satri';
        $this->data['content'] = $this->model->where(['id' => $id])->first();
        return view('master/santri/detail', $this->data);
    }

    public function foto($id = null): string
    {
        $this->data['submenu'] = 'detail satri';
        $this->data['content'] = $this->model->where(['id' => $id])->first();
        return view('master/santri/foto', $this->data);
    }

    public function process(): string
    {
        $data = $this->request->getPost('form');
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads/santri', $imageName);
            $data['image'] = $imageName;
        }
        if (isset($data['tanggal_lahir'])) {
            $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
        }
        if (isset($data['password']) && $data['password'] == '') {
            unset($data['password']);
        }

        // Hash the password before saving
        // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
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

    public function delete($id = null): string
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
