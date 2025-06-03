<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WisataModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardAdminController extends BaseController
{
    public function index()
    {
        $wisataModel = new WisataModel();
        $kriteriaModel = new KriteriaModel();
        $subKriteriaModel = new SubKriteriaModel();

        $data = [
            'title'             => 'Dashboard Admin',
            'jumlahWisata'      => $wisataModel->countAll(),
            'jumlahKriteria'    => $kriteriaModel->countAll(),
            'jumlahSubKriteria' => $subKriteriaModel->countAll()
        ];

        return view('admin/dashboard', $data);
    }
}
