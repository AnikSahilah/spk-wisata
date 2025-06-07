<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewsModels;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewsController extends BaseController
{
    public function index()
    {
        $reviewModel = new ReviewsModels();

        // Ambil data dengan join dan paginate 10 per halaman
        $reviews = $reviewModel
            ->select('reviews.*, wisata.nama_wisata')
            ->join('wisata', 'wisata.id = reviews.wisata_id')
            ->orderBy('reviews.created_at', 'DESC')
            ->paginate(10);  // paginate 10 per halaman

        // Untuk menampilkan link pagination di view nanti, kita juga butuh objek pager
        $pager = $reviewModel->pager;

        return view('reviews/index', [
            'reviews' => $reviews,
            'pager'   => $pager,
        ]);
    }
    public function simpan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'wisata_id' => 'required|is_natural_no_zero',
            'rating'    => 'required|integer|greater_than[0]|less_than_equal_to[5]',
            'komentar'  => 'permit_empty|string|max_length[1000]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $reviewModel = new ReviewsModels();
        $reviewModel->insert([
            'wisata_id' => $this->request->getPost('wisata_id'),
            'rating'    => $this->request->getPost('rating'),
            'komentar'  => $this->request->getPost('komentar'),
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
}
