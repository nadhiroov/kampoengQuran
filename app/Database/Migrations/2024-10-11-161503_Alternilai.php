<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alternilai extends Migration
{
    protected $tableName  = 'nilai';
    public function up()
    {
        $fields = [
            'id_siswa' => [
                'name' => 'id_santri',
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
        ];
        $this->forge->modifyColumn($this->tableName, $fields);
    }

    public function down()
    {
        $fields = [
            'id_santri' => [
                'name' => 'id_siswa',
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
        ];
        $this->forge->modifyColumn($this->tableName, $fields);
    }
}
