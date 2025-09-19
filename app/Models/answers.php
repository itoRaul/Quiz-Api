<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'alternative_id',
    ];

    public function participant()
    {
        return $this->belongsTo(participants::class);
    }

    public function alternative()
    {
        return $this->belongsTo(alternatives::class);
    }

    
}
