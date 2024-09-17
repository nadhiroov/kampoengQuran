<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class Core extends ResourceController
{
    protected $session;
    protected $view;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->view = \Config\Services::renderer();
    }
}
