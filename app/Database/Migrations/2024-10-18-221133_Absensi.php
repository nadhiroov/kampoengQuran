<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absensi extends Migration
{
    protected $tableName  = 'absensi';
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
            'sakit' => array(
                'type'          => 'tinyint',
                'unsigned'      => true,
                'default'       => 0
            ),
            'izin' => array(
                'type'          => 'tinyint',
                'unsigned'      => true,
                'default'       => 0
            ),
            'tanpa_keterangan' => array(
                'type'          => 'tinyint',
                'unsigned'      => true,
                'default'       => 0
            ),
            'catatan' => array(
                'type'          => 'text',
                'null'          => true,
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_santri', 'santri', 'id', 'restrict', 'restrict', 'fk_praktek_siswa');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_praktek_kelas');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
