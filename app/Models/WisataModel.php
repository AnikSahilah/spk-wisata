<?php

namespace App\Models;

use CodeIgniter\Model;

class WisataModel extends Model
{
    protected $table      = 'wisata';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $useTimestamps    = true; // Karena ada kolom created_at & updated_at

    protected $allowedFields = [
        'nama_wisata',
        'alamat',
        'sub_kriteria_id',
        'gambar',
    ];
}
