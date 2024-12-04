<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Master\Madmin;
use App\Models\Master\Mmateri;
use App\Models\Master\Msantri;
use App\Models\Master\Mustadz;
use App\Models\Mkelas;

class Dashboard extends BaseController
{
    protected $santri;
    protected $ustadz;
    protected $kelas;
    protected $admin;
    protected $materi;

    public function __construct()
    {
        $this->santri = new Msantri();
        $this->ustadz = new Mustadz();
        $this->kelas = new Mkelas();
        $this->admin = new Madmin();
        $this->materi = new Mmateri();
        $this->data['menu'] = 'Dashboard';
        $this->data['menu_dashboard'] = 'active';
    }

    public function index(): string
    {
        $this->data['total_admin'] = $this->admin->select('count(id) as total_admin')->first();
        $this->data['total_kelas'] = $this->kelas->select('count(id) as total_kelas')->first();
        // dd($this->data['total_admin']);
        return view('dashboard', $this->data);
    }

    public function getTotalSantri()
    {
        $totalSantri = $this->santri->select('sum(if(gender = "Pria", 1, 0)) as total_pria,sum(if(gender = "Wanita", 1, 0)) as total_wanita, angkatan')->groupBy('angkatan')->orderBy('angkatan desc')->limit(8)->findAll();
        return json_encode($totalSantri);
    }

    public function getTotalUstadz()
    {
        $ustadz = $this->ustadz->select('sum(if(gender = "Pria", 1, 0)) as total_pria, sum(if(gender = "Wanita", 1, 0)) as total_wanita')->findAll();
        return json_encode($ustadz);
    }

    public function getTotalMateri()
    {
        $materi = $this->materi->select('count(id) as total_materi, semester')->groupBy('semester')->orderBy('semester asc')->findAll();
        return json_encode($materi);
    }
}
