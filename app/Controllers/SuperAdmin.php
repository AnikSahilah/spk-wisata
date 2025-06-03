<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuperAdmin extends BaseController
{
    public function dashboard()
    {
        echo "Halo Super Admin, selamat datang di dashboard!";
    }
}
