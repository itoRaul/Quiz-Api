<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectAlternatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'alternative_id',
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternatives::class);
    }

    
}
