<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbtahunakademik extends Migration
{
    protected $tableName  = 'tahun_akademik';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'tahun_akademik' => array(
                'type'          => 'varchar',
                'constraint'    => 9,
                'default'       => null
            )
        ]);
        $this->forge->addkey('id', true);
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
