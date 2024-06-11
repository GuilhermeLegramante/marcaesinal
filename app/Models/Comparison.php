<?php

namespace App\Models;

use App\Utils\ArrayHandler;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    use HasFactory;

    protected $connection = 'update';

    protected $table = 'comparacao';

}
