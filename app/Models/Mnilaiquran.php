<?php

namespace App\Models;

use CodeIgniter\Model;

class Mnilaiquran extends Model
{
    protected $table            = 'nilai_quran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'id_santri', 'surat', 'nomor_surat', 'ayat', 'nilai'];
}
