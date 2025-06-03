<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'Isnaini',
                'email'    => 'super-admin@example.com',
                'password' => password_hash('super-admin123', PASSWORD_DEFAULT),
                'role'     => 'super_admin',
            ],
            [
                'username' => 'Sutrisno',
                'email'    => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
