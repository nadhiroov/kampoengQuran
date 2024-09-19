<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->data['menu_dashboard'] = 'active';
    }
    
    public function index(): string
    {
        return view('dashboard', $this->data);
    }
}
