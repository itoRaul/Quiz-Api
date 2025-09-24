<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeConfiguration extends Model
{
    use HasFactory;

    protected $table = 'alternatives_configuration';

    protected $fillable = [
        'name',
        'color_name',
        'color_hexadecimal',
        'status',
    ];

    public function alternatives()
    {
        return $this->hasOne(Alternative::class);
    }
}
