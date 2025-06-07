<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WisataModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\ReviewsModels as ReviewModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardAdminController extends BaseController
{
    public function index()
    {
        $wisataModel = new WisataModel();
        $kriteriaModel = new KriteriaModel();
        $subKriteriaModel = new SubKriteriaModel();
        $reviewModel = new ReviewModel();

        $db = \Config\Database::connect();

        $topWisata = $db->table('reviews')
            ->select('wisata.id, wisata.nama_wisata, AVG(reviews.rating) as rata_rating')
            ->join('wisata', 'wisata.id = reviews.wisata_id')
            ->groupBy('wisata.id')
            ->orderBy('rata_rating', 'DESC')
            ->limit(3)
            ->get()
            ->getResult();

        $data = [
            'title'             => 'Dashboard Admin',
            'jumlahWisata'      => $wisataModel->countAll(),
            'jumlahKriteria'    => $kriteriaModel->countAll(),
            'jumlahSubKriteria' => $subKriteriaModel->countAll(),
            'topWisata'         => $topWisata
        ];

        return view('admin/dashboard', $data);
    }
}
