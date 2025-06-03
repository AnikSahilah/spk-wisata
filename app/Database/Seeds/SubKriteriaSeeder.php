<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubKriteriaSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID kriteria berdasarkan nama
        $db = \Config\Database::connect();

        $kriteriaMap = [];
        $builder = $db->table('kriteria')->get()->getResultArray();

        foreach ($builder as $row) {
            $kriteriaMap[strtolower($row['nama_kriteria'])] = $row['id'];
        }

        $subKriteriaList = [
            // Jenis Wisata
            ['kriteria_id' => $kriteriaMap['jenis wisata'], 'nama' => 'Alam'],
            ['kriteria_id' => $kriteriaMap['jenis wisata'], 'nama' => 'Buatan'],
            ['kriteria_id' => $kriteriaMap['jenis wisata'], 'nama' => 'Budaya dan Sejarah'],

            // Fasilitas
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Toilet'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Parkiran'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Musholla'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Tempat Makan'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Penginapan'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Tempat Bermain'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Gazebo'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Spot Foto'],
            ['kriteria_id' => $kriteriaMap['fasilitas'], 'nama' => 'Papan Informasi'],

            // Harga Tiket
            ['kriteria_id' => $kriteriaMap['harga tiket'], 'nama' => '0-9.000'],
            ['kriteria_id' => $kriteriaMap['harga tiket'], 'nama' => '10.000-20.000'],
            ['kriteria_id' => $kriteriaMap['harga tiket'], 'nama' => '21.000-30.000'],
            ['kriteria_id' => $kriteriaMap['harga tiket'], 'nama' => 'Diatas 30.000'],

            // Jam Operasional
            ['kriteria_id' => $kriteriaMap['jam operasional'], 'nama' => '02.00-11.00'],
            ['kriteria_id' => $kriteriaMap['jam operasional'], 'nama' => '08.00-16.00'],
            ['kriteria_id' => $kriteriaMap['jam operasional'], 'nama' => '08.00-17.00'],

            // Akses
            ['kriteria_id' => $kriteriaMap['akses'], 'nama' => 'Motor'],
            ['kriteria_id' => $kriteriaMap['akses'], 'nama' => 'Mobil'],
            ['kriteria_id' => $kriteriaMap['akses'], 'nama' => 'Mobil Elf'],
            ['kriteria_id' => $kriteriaMap['akses'], 'nama' => 'Bus'],
        ];

        $this->db->table('sub_kriteria')->insertBatch($subKriteriaList);
    }
}
