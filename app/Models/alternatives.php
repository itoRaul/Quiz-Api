<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternatives extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'status',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(questions::class);
    }

    public function answers()
    {
        return $this->hasOne(answers::class);
    }

    public function correctAlternatives()
    {
        return $this->hasMany(correctAlternatives::class);
    }

    
}
