<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlteruserFullname extends Migration
{
    protected $tableName  = 'user';
    public function up()
    {
        $alterfields = [
            'fullname' => [
                'type'          => 'varchar',
                'constraint'    => 255,
                'default'       => null,
                'null'          => true,
            ],
            'email' => [
                'type'          => 'varchar',
                'constraint'    => 255,
                'default'       => null,
                'null'          => true,
            ],
        ];
        $this->forge->addColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'fullname, email');
    }
}
