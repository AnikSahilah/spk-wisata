<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $table      = 'sub_kriteria';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['kriteria_id', 'nama'];

    // Jika kamu ingin mengaktifkan timestamps (opsional, tergantung skema DB-mu)
    protected $useTimestamps = false;
}
