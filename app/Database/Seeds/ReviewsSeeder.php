<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\WisataModel;

class ReviewsSeeder extends Seeder
{
    public function run()
    {
        $wisataModel = new WisataModel();
        $wisataList = $wisataModel->findAll();

        if (empty($wisataList)) {
            echo "Seeder Reviews gagal: tabel wisata kosong.\n";
            return;
        }

        $reviewsData = [
            [
                'rating' => 5,
                'komentar' => 'Tempatnya sangat indah dan nyaman, wajib dikunjungi!',
            ],
            [
                'rating' => 4,
                'komentar' => 'Pemandangan bagus, tapi akses agak sulit.',
            ],
            [
                'rating' => 3,
                'komentar' => 'Biasa saja, tapi cocok untuk refreshing singkat.',
            ],
            [
                'rating' => 4,
                'komentar' => 'Pelayanan ramah dan fasilitas memadai.',
            ],
            [
                'rating' => 2,
                'komentar' => 'Kurang terawat dan kebersihan kurang.',
            ],
        ];

        // Insert review untuk beberapa wisata (acak)
        foreach ($wisataList as $wisata) {
            // Pilih 2-3 review secara acak dari $reviewsData
            $countReviews = rand(2, 3);
            $selectedReviews = array_rand($reviewsData, $countReviews);

            if (!is_array($selectedReviews)) {
                $selectedReviews = [$selectedReviews];
            }

            foreach ($selectedReviews as $index) {
                $review = $reviewsData[$index];

                $this->db->table('reviews')->insert([
                    'wisata_id'  => $wisata['id'],
                    'rating'     => $review['rating'],
                    'komentar'   => $review['komentar'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
