<?php

namespace App\Models;

use App\Enums\SurveyStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contents','description'];

    protected $appends = ['fields_count', 'assets'];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    // scope published
    public function scopePublished($query)
    {
        return $query->where('status', SurveyStatus::Published->value);
    }

    protected function contents(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

    protected function fieldsCount(): Attribute
    {
        return new Attribute(
            get: fn () => count($this->contents),
        );
    }

    protected function assets(): Attribute
    {
        return new Attribute(
            get: function () {
                $to_pluck = [];

                foreach ($this->contents as $field) {
                    if (
                        $field->type === 'image_singleselect' ||
                        $field->type === 'image_multiselect'
                    ) {
                        foreach ($field->options as $option) {
                            $to_pluck[] = $option->value;
                        }
                    }
                }
                $assets = [];
                $pics = Picture::whereIn('id', $to_pluck)->get();
                foreach ($pics as $pic) {
                    $assets["$pic->id"] = $pic->url;
                }

                return $assets;
            }
        );
    }
}
