<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Altersantri extends Migration
{
    protected $tableName  = 'santri';
    public function up()
    {
        $alterfields = [
            'tanggal_lahir' => [
                'type'          => 'varchar',
                'constraint'    => 255,
                'default'       => null,
                'null'          => true,
            ],
            'alamat_asal' => [
                'type'          => 'varchar',
                'constraint'    => 255,
                'default'       => null,
                'null'          => true,
            ],
            'alamat_domisili' => [
                'type'          => 'varchar',
                'constraint'    => 255,
                'default'       => null,
                'null'          => true,
            ],
            'angkatan' => [
                'type'          => 'int',
                'constraint'    => 4,
                'default'       => null,
                'null'          => true,
            ],
        ];
        $this->forge->addColumn($this->tableName, $alterfields);

        $alterfields = [
            'gender' => array(
                'type'          => 'ENUM("Pria","Wanita")',
                'null'          => false,
            )
        ];
        $this->forge->modifyColumn($this->tableName, $alterfields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tableName, 'tanggal_lahir, alamat_asal, alamat_domisili, angkatan');
        $alterfields = [
            'gender' => array(
                'type'          => 'ENUM("male","female")',
                'null'          => false,
            )
        ];
        $this->forge->modifyColumn($this->tableName, $alterfields);
    }
}
