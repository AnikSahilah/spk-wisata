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
                'bobot'        => 0.00,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Fasilitas',
                'type'         => 'benefit',
                'bobot'        => 0.35,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Harga Tiket',
                'type'         => 'cost',
                'bobot'        => 0.38,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Jam Operasional',
                'type'         => 'benefit',
                'bobot'        => 0.12,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kriteria' => 'Akses',
                'type'         => 'benefit',
                'bobot'        => 0.15,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data ke tabel kriteria
        $this->db->table('kriteria')->insertBatch($data);
    }
}
