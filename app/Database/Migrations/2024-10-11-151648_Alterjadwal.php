<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alterjadwal extends Migration
{
    protected $tableName  = 'jadwal';
    public function up()
    {
        $fields = [
            'id_submateri' => [
                'name' => 'id_materi',
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
        ];

        $this->forge->modifyColumn($this->tableName, $fields);
        $this->forge->dropForeignKey($this->tableName, 'fk_submateri_jadwal');
        $this->forge->addForeignKey('id_materi', 'materi', 'id', 'restrict', 'restrict', 'fk_materi_jadwal');
    }

    public function down()
    {
        $this->forge->dropForeignKey($this->tableName, 'fk_materi_jadwal');
        $fields = [
            'id_materi' => [
                'name' => 'id_submateri',
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
        ];
        $this->forge->modifyColumn($this->tableName, $fields);
        $this->forge->addForeignKey('id_submateri', 'submateri', 'id', 'restrict', 'restrict', 'fk_submateri_jadwal');
    }
}
