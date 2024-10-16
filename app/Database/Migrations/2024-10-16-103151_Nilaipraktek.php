<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilaipraktek extends Migration
{
    protected $tableName  = 'nilai_praktek';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'id_santri' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'id_kelas' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'id_praktek' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'nilai' => array(
                'type'          => 'varchar',
                'constraint'    => 3,
                'null'          => true,
            ),
            'deskripsi' => array(
                'type'          => 'text',
                'null'          => true,
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_santri', 'santri', 'id', 'restrict', 'restrict', 'fk_nilaiPraktek_siswa');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_nilaiPraktek_kelas');
        $this->forge->addForeignKey('id_praktek', 'praktek', 'id', 'restrict', 'restrict', 'fk_nilaiPraktek_materi');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
