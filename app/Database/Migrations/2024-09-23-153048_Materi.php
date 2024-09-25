<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Materi extends Migration
{
    protected $tableName  = 'materi';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'materi' => array(
                'type'          => 'varchar',
                'constraint'    => 100,
                'null'          => true,
            ),
            'created_at' => array(
                'type'          => 'datetime',
                'default'       => new RawSql('CURRENT_TIMESTAMP'),
                'null'          => true,
            ),
            'updated_at' => array(
                'type'          => 'datetime',
                'default'       => null,
                'null'          => true,
            ),
            'deleted_at' => array(
                'type'          => 'datetime',
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