<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan semua seeder yang ingin dijalankan di sini:
        $this->call('UserSeeder');
        $this->call('KriteriaSeeder');
        $this->call('SubKriteriaSeeder');
        $this->call('WisataSeeder');
        $this->call('NilaiAlternatifSeeder');
        $this->call('ReviewsSeeder');

        // Contoh tambahan:
        // $this->call('PostSeeder');
        // $this->call('CategorySeeder');
    }
}
