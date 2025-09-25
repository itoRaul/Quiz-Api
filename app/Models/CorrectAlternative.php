<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectAlternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'alternative_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    
}
