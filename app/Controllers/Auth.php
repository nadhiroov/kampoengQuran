<?php

namespace App\Controllers;

class Auth extends Core
{
    protected $modelName = 'App\Models\User\Madmin';

    public function index(): string
    {
        return view('Login');
    }

    public function login()
    {
        $param = $this->request->getPost('param');
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
        if ($this->request->getHeaderLine('type') == 'api') {
            if ($return['status'] == 1) return $this->respond($return);
            return $this->respond($return, 404);
        } else {
            if ($return['status'] == 1) {
                $data['logged_in'] = true;
                $this->session->set($data);
                return redirect()->to('ci');
            }else{
                $this->session->setFlashdata('msg_pass', $return['message']);
                return redirect()->to('/');
            }
        }
    }
}
