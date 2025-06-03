<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiAlternatifModel extends Model
{
    protected $table      = 'nilai_alternatif';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'wisata_id',
        'sub_kriteria_id',
        'nilai',
    ];
}
