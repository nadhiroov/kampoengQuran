<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    protected $tableName  = 'jadwal';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'id_kelas' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'id_submateri' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'hari' => array(
                'type'          => 'varchar',
                'constraint'    => 10,
                'default'       => null,
            ),
            'jam_awal' => array(
                'type'          => 'varchar',
                'constraint'    => 5,
                'default'       => null,
            ),
            'jam_akhir' => array(
                'type'          => 'varchar',
                'constraint'    => 5,
                'default'       => null
            ),
            'lokasi' => array(
                'type'          => 'varchar',
                'constraint'    => 100,
                'default'       => null
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_kelas_jadwal');
        $this->forge->addForeignKey('id_submateri', 'submateri', 'id', 'restrict', 'restrict', 'fk_submateri_jadwal');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
