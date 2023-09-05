<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id',
        'ip',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
