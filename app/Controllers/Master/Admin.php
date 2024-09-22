<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\Madmin;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->model = new Madmin();
    }

    public function index(): string
    {
        $this->view->setData(['menu_master' => 'active', 'submenu_admin' => 'active']);
        $this->data['menu'] = 'Master data admin';
        return view('master/admin/index', $this->data);
    }

    public function getData(): string
    {
        $param = $this->request->getPost();
        // return $this->respond($this->request->getPost());
        $data = $this->model->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('username', 'asc');
        if (!empty($param['search']['value'])) {
            $data = $this->model->like('username', $param['search']['value']);
            $data = $this->model->orLike('fullname', $param['search']['value']);
            $data = $this->model->orLike('email', $param['search']['value']);
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
        $this->data['content'] = $this->model->where(['id' => $id])->first();
        return view('master/admin/edit', $this->data);
    }

    public function process(): string
    {
        $data = $this->request->getPost('form');
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads/admin', $imageName);
            $data['image'] = $imageName;
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
