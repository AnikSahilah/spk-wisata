<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'kriteria';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['nama_kriteria', 'bobot', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
}
