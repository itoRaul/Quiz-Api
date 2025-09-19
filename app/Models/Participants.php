<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
    ];

    public function answers()
    {
        return $this->hasMany(answers::class);
    }
    
}
