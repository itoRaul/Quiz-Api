<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatives extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'status',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }

    public function answers()
    {
        return $this->hasOne(Answers::class);
    }

    public function correctAlternatives()
    {
        return $this->hasMany(CorrectAlternatives::class);
    }

    
}
