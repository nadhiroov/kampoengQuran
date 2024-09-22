<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasSantri extends Migration
{
    protected $tableName  = 'kelas_santri';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'id_kelas' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ),
            'id_santri' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            )
        ]);
        $this->forge->addkey('id', true);
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'restrict', 'restrict', 'fk_kelas');
        $this->forge->addForeignKey('id_santri', 'santri', 'id', 'restrict', 'restrict', 'fk_santri');
        $this->forge->createtable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
