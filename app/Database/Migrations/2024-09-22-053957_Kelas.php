<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Kelas extends Migration
{
    protected $tableName  = 'master_kelas';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'name_kelas' => array(
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
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
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
