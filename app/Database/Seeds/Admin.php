<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        //
        $data = [
            'username' => 'hawxly',
            'email' => 'hawxly01@gmail.com',
            'password' => password_hash('12345', PASSWORD_DEFAULT),
        ];
        $this->db->table('admin')->insert($data);
        // $data = [
        //     'username' => 'adminhr',
        //     'email' => 'adminhr@gmail.com',
        //     'password' => password_hash('12345', PASSWORD_DEFAULT),
        // ];
        // $this->db->table('admin')->insert($data);
        // $this->forge->addPrimaryKey($data['email']);
    }
}
