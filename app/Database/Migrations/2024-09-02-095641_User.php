<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class User extends Migration
{
    protected $tableName  = 'user';
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ),
            'password' => array(
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ),
            'image'   => array(
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'default'       => 'user.png',
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
