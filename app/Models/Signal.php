<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Signal extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'signal_type_id',
        'position',
        'note',
    ];

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }

    public function signalType(): BelongsTo
    {
        return $this->belongsTo(SignalType::class);
    }
}
