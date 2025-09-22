<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sequence',
        'status',
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternatives::class);
    }

    public function correctAlternatives()
    {
        return $this->hasOne(CorrectAlternatives::class);
    }

    
}
