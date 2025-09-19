<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sequence',
        'status',
    ];

    public function alternatives()
    {
        return $this->hasMany(alternatives::class);
    }

    public function correctAlternatives()
    {
        return $this->hasOne(correctAlternatives::class);
    }

    
}
