<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Kelas extends Migration
{
    protected $tableName  = 'kelas';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'nama_kelas' => array(
                'type'          => 'VARCHAR',
                'constraint'    => 25,
                'null'          => true,
            ),
            'semester' => array(
                'type'          => 'tinyint',
                'constraint'    => 1,
                'null'          => true,
            ),
            'tahun_ajaran' => array(
                'type'          => 'VARCHAR',
                'constraint'    => 9,
                'null'          => true,
            ),
            'id_ustadz' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'created_at' => array(
                'type'          => 'DATETIME',
                'default'       => new RawSql('CURRENT_TIMESTAMP'),
                'null'          => true,
            ),
            'updated_at' => array(
                'type'          => 'DATETIME',
                'default'       => null,
                'null'          => true,
            ),
            'deleted_at' => array(
                'type'          => 'DATETIME',
                'default'       => NULL,
                'null'          => true,
            ),
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_ustadz', 'ustadz', 'id', 'restrict', 'restrict', 'fk_ustadz');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
