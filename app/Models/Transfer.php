<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'from_id',
        'to_id',
        'note',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(Farmer::class, 'from_id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(Farmer::class, 'to_id');
    }
}
