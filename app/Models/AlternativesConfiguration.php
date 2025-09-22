<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativesConfiguration extends Model
{
    use HasFactory;

    protected $table = 'alternatives_configuration';

    protected $fillable = [
        'name',
        'color_name',
        'color_hexadecimal',
        'status',
    ];
}
