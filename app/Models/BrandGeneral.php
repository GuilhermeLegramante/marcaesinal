<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandGeneral extends Model
{
    use HasFactory;

    protected $connection = 'general';

    protected $table = 'brands_info';
}
