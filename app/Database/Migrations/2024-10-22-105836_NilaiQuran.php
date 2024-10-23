<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiQuran extends Migration
{
    protected $tableName  = 'nilai_quran';
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
            'surat' => array(
                'type'          => 'varchar',
                'constraint'    => 50,
                'null'          => false,
            ),
            'ayat' => array(
                'type'          => 'smallint',
                'unsigned'      => true,
                'default'       => 0
            ),
            'nilai' => array(
                'type'          => 'tinyint',
                'null'          => true,
                'default'       => 0
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_santri', 'santri', 'id', 'restrict', 'restrict', 'fk_nilaiQuran_siswa');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_nilaiQuran_kelas');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
