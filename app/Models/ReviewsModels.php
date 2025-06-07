<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewsModels extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['wisata_id', 'rating', 'komentar', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
}
