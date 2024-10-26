<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alternilaipraktek extends Migration
{
    protected $tableName  = 'nilai_praktek';
    public function up()
    {
        $alterfields = [
            'nilai_keterampilan' => array(
                'type'          => 'varchar',
                'constraint'    => 3,
                'null'          => true,
            ),
            'deskripsi_keterampilan' => array(
                'type'          => 'text',
                'null'          => true,
            ),
        ];
        $this->forge->addColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'nilai_keterampilan, deskripsi_keterampilan');
    }
}
