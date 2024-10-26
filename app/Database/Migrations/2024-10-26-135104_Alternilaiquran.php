<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alternilaiquran extends Migration
{
    protected $tableName  = 'nilai_quran';
    public function up()
    {
        $alterfields = [
            'nomor_surat' => [
                'type'          => 'tinyint',
                'null'          => true,
                'default'       => null,
                'after'         => 'surat'
            ]
        ];
        $this->forge->addColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'nomor_surat');
    }
}
