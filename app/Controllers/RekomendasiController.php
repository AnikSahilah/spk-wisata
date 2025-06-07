<?php

namespace App\Controllers;

use App\Models\WisataModel;
use App\Models\KriteriaModel;
use App\Models\NilaiAlternatifModel;
use App\Models\SubKriteriaModel;

class RekomendasiController extends BaseController
{
    protected $wisataModel;
    protected $kriteriaModel;
    protected $nilaiModel;
    protected $subKriteriaModel;

    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->nilaiModel = new NilaiAlternatifModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }

    public function filterForm()
    {
        helper('form');

        $kriteria = $this->kriteriaModel->findAll();

        // Kelompokkan sub-kriteria berdasarkan kriteria
        $subKriteria = [];
        foreach ($kriteria as $k) {
            $subKriteria[$k['nama_kriteria']] = $this->subKriteriaModel
                ->where('kriteria_id', $k['id'])
                ->findAll();
        }

        return view('rekomendasi/index', [
            'kriteria' => $kriteria,
            'subKriteria' => $subKriteria
        ]);
    }

    public function index()
    {
        $subKriteriaInput = $this->request->getPost('sub_kriteria');

        $selectedSubKriteriaIds = [];
        foreach ($subKriteriaInput as $value) {
            if (is_array($value)) {
                $selectedSubKriteriaIds = array_merge($selectedSubKriteriaIds, $value);
            } else {
                $selectedSubKriteriaIds[] = $value;
            }
        }

        // Ambil ID sub_kriteria yang berkaitan dengan "Jenis Wisata"
        $jenisWisataSubIds = $this->subKriteriaModel
            ->select('sub_kriteria.id')
            ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id')
            ->where('kriteria.nama_kriteria', 'Jenis Wisata')
            ->findAll();

        $jenisWisataIds = array_column($jenisWisataSubIds, 'id');
        $jenisYangDipilih = array_intersect($selectedSubKriteriaIds, $jenisWisataIds);

        // Filter wisata berdasarkan sub_kriteria jenis wisata
        $wisataFiltered = $this->wisataModel
            ->whereIn('sub_kriteria_id', $jenisYangDipilih)
            ->findAll();

        if (empty($wisataFiltered)) {
            return view('rekomendasi/hasil', ['result' => [], 'message' => 'Tidak ditemukan wisata sesuai filter']);
        }

        $wisataIds = array_column($wisataFiltered, 'id');

        // Ambil nilai alternatif
        $db = \Config\Database::connect();
        $builder = $db->table('nilai_alternatif na');
        $builder->select('na.wisata_id, sk.kriteria_id, na.nilai');
        $builder->join('sub_kriteria sk', 'na.sub_kriteria_id = sk.id');
        $builder->whereIn('na.wisata_id', $wisataIds);

        if (!empty($selectedSubKriteriaIds)) {
            $builder->whereIn('na.sub_kriteria_id', $selectedSubKriteriaIds);
        }

        $rows = $builder->get()->getResultArray();

        // Kelompokkan nilai berdasarkan wisata dan kriteria
        $nilaiSementara = [];
        foreach ($rows as $row) {
            $kriteriaId = $row['kriteria_id'];
            $nilaiSementara[$row['wisata_id']][$kriteriaId][] = $row['nilai'];
        }

        $nilaiAlternatif = [];
        foreach ($nilaiSementara as $wisataId => $kriteriaArray) {
            foreach ($kriteriaArray as $kriteriaId => $nilaiList) {
                $avg = array_sum($nilaiList) / count($nilaiList);
                $nilaiAlternatif[$wisataId][$kriteriaId] = $avg;
            }
        }

        $hasil = $this->hitungSAW($nilaiAlternatif);
        arsort($hasil);
        $top3 = array_slice($hasil, 0, 3, true);

        $result = [];
        foreach ($top3 as $wisataId => $score) {
            $wisata = $this->wisataModel->find($wisataId);
            $result[] = [
                'wisata' => $wisata,
                'score' => $score,
            ];
        }

        return view('rekomendasi/hasil', compact('result'));
    }

    protected function hitungSAW(array $nilaiAlternatif): array
    {
        $kriteriaList = $this->kriteriaModel->findAll();
        $bobot = [];
        $tipe = [];
        $skipKriteriaIds = [];

        foreach ($kriteriaList as $k) {
            if ($k['nama_kriteria'] === 'Jenis Wisata') {
                $skipKriteriaIds[] = $k['id'];
                continue;
            }

            $bobot[$k['id']] = floatval($k['bobot']);
            $tipe[$k['id']] = $k['type'];
        }

        $maxPerKriteria = [];
        $minPerKriteria = [];

        foreach ($nilaiAlternatif as $wisataId => $kriteriaNilai) {
            foreach ($kriteriaNilai as $kriteriaId => $nilai) {
                if (in_array($kriteriaId, $skipKriteriaIds)) continue;

                $maxPerKriteria[$kriteriaId] = max($maxPerKriteria[$kriteriaId] ?? $nilai, $nilai);
                $minPerKriteria[$kriteriaId] = min($minPerKriteria[$kriteriaId] ?? $nilai, $nilai);
            }
        }

        $hasil = [];
        foreach ($nilaiAlternatif as $wisataId => $kriteriaNilai) {
            $total = 0;
            foreach ($kriteriaNilai as $kriteriaId => $nilai) {
                if (in_array($kriteriaId, $skipKriteriaIds)) continue;

                $max = $maxPerKriteria[$kriteriaId] ?? 1;
                $min = $minPerKriteria[$kriteriaId] ?? 0;

                $normalized = ($tipe[$kriteriaId] === 'benefit') ? $nilai / $max : $min / $nilai;
                $total += $normalized * ($bobot[$kriteriaId] ?? 0);
            }
            $hasil[$wisataId] = $total;
        }

        return $hasil;
    }
}
