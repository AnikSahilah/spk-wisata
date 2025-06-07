<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WisataModel;
use App\Models\ReviewsModels;
use App\Models\SubKriteriaModel;

class HomeController extends BaseController
{
    public function index()
    {
        $wisataModel = new WisataModel();
        $wisata = $wisataModel->findAll();

        return view('user/landing_page/index', ['wisata' => $wisata]);
    } // pastikan model ini ada

    public function detail($id)
    {
        $wisataModel = new WisataModel();
        $reviewModel = new ReviewsModels();
        $subModel = new SubKriteriaModel();

        $wisata = $wisataModel->find($id);
        if (!$wisata) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Wisata tidak ditemukan.");
        }

        $ulasan = $reviewModel->where('wisata_id', $id)->orderBy('created_at', 'DESC')->findAll();
        $rating = $reviewModel->select('AVG(rating) as avg_rating, COUNT(*) as total_ulasan')
            ->where('wisata_id', $id)
            ->get()->getRow();

        // Ambil jenis wisata dari tabel sub_kriteria
        $jenisWisata = $subModel->find($wisata['sub_kriteria_id']);

        return view('user/wisata/detail', [
            'wisata' => $wisata,
            'ulasan' => $ulasan,
            'rating' => $rating,
            'jenisWisata' => $jenisWisata
        ]);
    }
}
