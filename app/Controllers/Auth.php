<?php

namespace App\Controllers;

use App\Models\Master\Msantri;
use App\Models\Master\Mustadz;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $modelName = 'App\Models\Master\Madmin';

    public function index(): string
    {
        return view('login');
    }

    public function login()
    {
        $param = $this->request->getPost();
        $return = ['status' => 0, 'message' => ''];
        if (!empty($param['username']) && !empty($param['password'])) {
            $data = $this->model->where('username', $param['username'])->first();
            if ($data) {
                if ($param['password'] == $data['password']) {
                    $return = [
                        'status' => 1,
                        'message' => 'logged in'
                    ];
                    $data['logged_in'] = true;
                    $this->session->set($data);
                } else {
                    $return = [
                        'status' => 0,
                        'message' => 'username or password is incorrect'
                    ];
                }
            } else {
                $return = [
                    'status' => 0,
                    'message' => 'username or password is incorrect'
                ];
            }
        }
        if ($return['status'] == 1) {
            $data['logged_in'] = true;
            $this->session->set($data);
            return redirect()->to('dashboard');
        } else {
            $this->session->setFlashdata('msg_pass', $return['message']);
            return redirect()->to('/');
        }
    }

    public function loginUser()
    {
        $param = $this->request->getPost();
        $ustadz = new Mustadz();
        $santri = new Msantri();
        if (!empty($param['username']) && !empty($param['password'])) {
            $data = $ustadz->where(['username' => $param['username'], 'password' => $param['password']])->first();
            if (empty($data)) {
                $data = $santri->where(['nis' => $param['username'], 'password' => $param['password']])->first();
                if (empty($data)) {
                    $return = [
                        'status'  => 0,
                        'message' => 'user tidak ditemukan'
                    ];
                    $stts = 404;
                } else {
                    $return = [
                        'status'    => 1,
                        'role'      => 'santri',
                        'data'      => $data
                    ];
                    $stts = 200;
                }
            } else {
                $return = [
                    'status'    => 1,
                    'role'      => 'ustadz',
                    'data'      => $data
                ];
                $stts = 200;
            }
        } else {
            $return = [
                'status' => 0,
                'message' => 'username dan password tidak boleh kosong'
            ];
            $stts = 404;
        }
        return $this->respond($return, $stts);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
