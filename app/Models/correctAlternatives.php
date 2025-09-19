<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class correctAlternatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'alternative_id',
    ];

    public function question()
    {
        return $this->belongsTo(questions::class);
    }

    public function alternative()
    {
        return $this->belongsTo(alternatives::class);
    }

    
}
