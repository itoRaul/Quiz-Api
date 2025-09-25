<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sequence',
        'status',
        'alternative_correct',
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'question_id', 'id');
    }

    public function correctAlternatives()
    {
        return $this->hasMany(CorrectAlternative::class);
    }

    
}
