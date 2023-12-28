<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 33,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'title_seo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'post' => [
                'type' => 'longtext',
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['page', 'article'],
                'default' => 'article'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active'
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => 138,
            ],
            'desc' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created timestamp default now()'
        ]);
        $this->forge->addKey('post_id', true);
        $this->forge->addForeignKey('username', 'admin', 'username');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        //
        $this->forge->dropTable('posts');
    }
}
