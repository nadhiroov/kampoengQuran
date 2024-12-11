<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterNilaiQuranHalaman extends Migration
{
    protected $tableName  = 'nilai_quran';
    public function up()
    {
        $alterfields = [
            'halaman' => array(
                'type'          => 'tinyint',
                'after'         => 'surat',
                'constraint'    => 3,
                'unsigned'      => true,
                'null'          => true,
                'default'       => null
            )
        ];
        $this->forge->addColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'halaman');
    }
}
