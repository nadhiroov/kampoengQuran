<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilai extends Migration
{
    protected $tableName  = 'nilai';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'id_siswa' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'id_kelas' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'id_materi' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'nilai' => array(
                'type'          => 'varchar',
                'constraint'    => 100,
                'null'          => true,
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_siswa', 'materi', 'id', 'restrict', 'restrict', 'fk_nilai_siswa');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_nilai_kelas');
        $this->forge->addForeignKey('id_materi', 'materi', 'id', 'restrict', 'restrict', 'fk_nilai_materi');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
