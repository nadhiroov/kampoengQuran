<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class Mjadwal extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'hari', 'jam_awal', 'jam_akhir', 'lokasi'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
