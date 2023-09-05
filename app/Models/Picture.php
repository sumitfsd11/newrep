<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $appends = [
        'url',
    ];

    protected $fillable = [
        'name',
        'path',
    ];

    public function getUrlAttribute()
    {
        return asset('storage/'.$this->path);
    }
}
