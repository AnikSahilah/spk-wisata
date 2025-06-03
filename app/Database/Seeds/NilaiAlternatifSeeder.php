<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NilaiAlternatifSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $wisatas = $db->table('wisata')->get()->getResult();
        $subKriteriaModel = $db->table('sub_kriteria')->get()->getResult();

        // Kelompokkan subkriteria berdasarkan kategori fasilitas, akses, harga, jam
        $fasilitasSubs = [];
        $aksesSubs = [];
        $hargaSubs = [];
        $jamSubs = [];

        foreach ($subKriteriaModel as $sub) {
            $nama = strtolower($sub->nama);
            if (in_array($nama, ['toilet', 'parkiran', 'musholla', 'tempat makan', 'penginapan', 'tempat bermain', 'gazebo', 'spot foto', 'papan informasi'])) {
                $fasilitasSubs[$nama] = $sub->id;
            } elseif (in_array($nama, ['motor', 'mobil', 'mobil elf', 'bus'])) {
                $aksesSubs[$nama] = $sub->id;
            } elseif (in_array($nama, ['0-9.000', '10.000-20.000', '21.000-30.000', 'diatas 30.000'])) {
                $hargaSubs[$nama] = $sub->id;
            } elseif (in_array($nama, ['02.00-11.00', '08.00-16.00', '08.00-17.00'])) {
                $jamSubs[$nama] = $sub->id;
            }
        }

        foreach ($wisatas as $w) {
            // Fasilitas (9 nilai, 1 atau 0)
            $fasilitas = array_map('trim', explode(',', strtolower($w->fasilitas ?? '')));
            foreach ($fasilitasSubs as $nama => $idSub) {
                $nilai = in_array($nama, $fasilitas) ? 1 : 0;
                $this->insertNilaiAlternatif($db, $w->id, $idSub, $nilai);
            }

            // Akses (4 nilai, 1 atau 0)
            $akses = strtolower($w->akses ?? '');
            foreach ($aksesSubs as $nama => $idSub) {
                $nilai = str_contains($akses, $nama) ? 1 : 0;
                $this->insertNilaiAlternatif($db, $w->id, $idSub, $nilai);
            }

            // Harga tiket (1 nilai sesuai range)
            $hargaTiket = (int) preg_replace('/[^\d]/', '', $w->harga_tiket);
            $hargaRanges = [
                ['label' => '0-9.000', 'check' => fn($v) => $v <= 9000, 'score' => 5],
                ['label' => '10.000-20.000', 'check' => fn($v) => $v > 9000 && $v <= 20000, 'score' => 4],
                ['label' => '21.000-30.000', 'check' => fn($v) => $v > 20000 && $v <= 30000, 'score' => 3],
                ['label' => 'diatas 30.000', 'check' => fn($v) => $v > 30000, 'score' => 1],
            ];
            foreach ($hargaRanges as $item) {
                $key = strtolower($item['label']);
                if ($item['check']($hargaTiket) && isset($hargaSubs[$key])) {
                    $this->insertNilaiAlternatif($db, $w->id, $hargaSubs[$key], $item['score']);
                    break;
                }
            }

            // Jam operasional (1 nilai sesuai durasi)
            $jam = strtolower($w->jam_operasional ?? '');
            preg_match('/(\d{2}[:.]?\d{2})\s*-\s*(\d{2}[:.]?\d{2})/', $jam, $matches);
            $nilaiJam = 0; // default 0 kalau gagal
            if (count($matches) === 3) {
                $start = strtotime(str_replace('.', ':', $matches[1]));
                $end = strtotime(str_replace('.', ':', $matches[2]));
                if ($start !== false && $end !== false) {
                    $durasi = ($end - $start) / 3600;
                    if ($durasi >= 9) $nilaiJam = 5;
                    elseif ($durasi >= 7) $nilaiJam = 4;
                    elseif ($durasi >= 5) $nilaiJam = 3;
                    elseif ($durasi >= 3) $nilaiJam = 2;
                    else $nilaiJam = 1;
                }
            }

            // Pilih subkriteria jam yang sesuai label (jika ada)
            $subJamId = null;
            foreach ($jamSubs as $label => $idSub) {
                if (str_contains($jam, explode('-', $label)[0]) && str_contains($jam, explode('-', $label)[1])) {
                    $subJamId = $idSub;
                    break;
                }
            }

            // Kalau gak ketemu label jam, pilih salah satu jam secara default (misal yang pertama)
            if (!$subJamId && count($jamSubs) > 0) {
                $subJamId = reset($jamSubs);
            }

            if ($subJamId) {
                $this->insertNilaiAlternatif($db, $w->id, $subJamId, $nilaiJam);
            }
        }

        echo "Seeder nilai_alternatif selesai.\n";
    }

    private function insertNilaiAlternatif($db, $wisataId, $subKriteriaId, $nilai)
    {
        $db->table('nilai_alternatif')->replace([
            'wisata_id' => $wisataId,
            'sub_kriteria_id' => $subKriteriaId,
            'nilai' => $nilai
        ]);
    }
}
