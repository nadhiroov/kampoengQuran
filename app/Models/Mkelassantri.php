<?php

namespace App\Models;

use CodeIgniter\Model;

class Mkelassantri extends Model
{
    protected $table            = 'kelas_santri';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'id_santri'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
