<?php

namespace App\Models;

use CodeIgniter\Model;

class Mabsensi extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_santri', 'id_kelas', 'sakit', 'izin', 'tanpa_keterangan', 'catatan'];
}
