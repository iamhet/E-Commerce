<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class general_settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_name',
        'company_domain',
        'company_logo',
        'company_dark_logo',
        'favicon'
    ];
}
