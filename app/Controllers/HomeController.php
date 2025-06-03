<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WisataModel;

class HomeController extends BaseController
{
    public function index()
    {
        $wisataModel = new WisataModel();
        $wisata = $wisataModel->findAll();

        return view('user/landing_page/index', ['wisata' => $wisata]);
    }
}
