<?php

namespace App\Models;

use CodeIgniter\Model;

class Mjadwal extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'id_materi','hari', 'jam_awal', 'jam_akhir', 'lokasi', 'id_ustadz'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
