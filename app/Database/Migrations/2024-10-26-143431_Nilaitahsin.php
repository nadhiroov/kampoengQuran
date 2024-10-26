<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilaitahsin extends Migration
{
    protected $tableName  = 'nilai_tahsin';
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
            'fashohah' => array(
                'type'          => 'tinyint',
                'null'          => true,
                'default'       => 0
            ),
            'tajwid' => array(
                'type'          => 'tinyint',
                'null'          => true,
                'default'       => 0
            ),
            'kelancaran' => array(
                'type'          => 'tinyint',
                'null'          => true,
                'default'       => 0
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_santri', 'santri', 'id', 'restrict', 'restrict', 'fk_nilaiTahsin_siswa');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_nilaiTahsin_kelas');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
