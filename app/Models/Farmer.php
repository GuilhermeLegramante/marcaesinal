<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf_cnpj',
        'name',
        'email',
        'phone',
        'whatsapp',
        'birth_date',
        'gender',
        'address_id',
        'note',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

   
}
