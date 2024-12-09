<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class MtahunAkademik extends Model
{
    protected $table            = 'tahun_akademik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tahun_akademik'];
}
