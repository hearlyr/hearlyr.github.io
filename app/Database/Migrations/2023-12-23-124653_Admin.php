<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 33,
                'unique' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'last_login timestamp default now()'
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('admin', TRUE);;
    }

    public function down()
    {
        //
        $this->forge->dropTable('admin');
    }
}
