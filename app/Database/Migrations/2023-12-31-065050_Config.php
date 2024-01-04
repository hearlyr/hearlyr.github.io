<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Config extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'conf_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'conf_value' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('config');
    }

    public function down()
    {
        //
    }
}
