<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alterjadwal extends Migration
{
    protected $tableName  = 'jadwal';
    public function up()
    {
        $alterfields = [
            'id_ustadz' => [
                'type'          => 'int',
                'constraint'    => 11,
                'null'          => true,
                'default'       => null,
            ]
        ];
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_jadwal_ustadz');
        $this->forge->addColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'id_ustadz');
    }
}
