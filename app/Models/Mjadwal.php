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
    protected $allowedFields    = ['id_kelas', 'id_submateri','hari', 'jam_awal', 'jam_akhir', 'lokasi'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
