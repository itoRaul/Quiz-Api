<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $table = 'alternatives';
    
    protected $fillable = [
        'name',
        'status',
        'question_id',
        'alternatives_configuration_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasOne(Answers::class);
    }

    public function alternativesConfiguration()
    {
        return $this->belongsTo(AlternativeConfiguration::class);
    }
    
    
}
