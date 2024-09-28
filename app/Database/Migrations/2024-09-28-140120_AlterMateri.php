<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMateri extends Migration
{
    protected $tableName  = 'materi';
    public function up()
    {
        $alterfields = [
            'semester' => [
                'type'          => 'tinyint',
                'constraint'    => 1,
                'null'          => true,
                'default'       => 1,
            ]
        ];
        $this->forge->addColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'semester');
    }
}
