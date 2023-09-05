<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id', 'contents'];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    protected function contents(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

    public function ip(): HasOne
    {
        return $this->hasOne(Ip::class);
    }
}
