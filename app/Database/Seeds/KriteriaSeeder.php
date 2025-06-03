<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kriteria' => 'Jenis Wisata',
                'type'         => 'benefit',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Fasilitas',
                'type'         => 'benefit',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Harga Tiket',
                'type'         => 'cost',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Jam Operasional',
                'type'         => 'benefit',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Akses',
                'type'         => 'benefit',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data ke tabel kriteria
        $this->db->table('kriteria')->insertBatch($data);
    }
}
