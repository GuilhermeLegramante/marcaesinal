<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "city",
        "state",
        "cnpj",
        "phone",
        "address",
        "department_name",
        "years_validity",
        "renewal_deadline",
        "show_note_on_brand_title",
        "suggest_brand_number",
        "show_signals_on_brand_title",
        "show_report_header",
        "show_report_watermark",
    ];
}
