<?php

namespace App\Models;

use CodeIgniter\Model;

class Mnilai extends Model
{
    protected $table            = 'nilai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_santri', 'id_kelas', 'id_materi', 'nilai'];
}
