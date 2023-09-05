<?php

namespace App\Http\Resources;

use App\Enums\SurveyStatus;
use App\Helpers\EnumHelper;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SurveyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(fn ($survey) => [
                'id' => $survey->id,
                'title' => $survey->name,
                'status' => EnumHelper::vk(SurveyStatus::cases())[$survey->status],
                'fields_count' => $survey->fields_count,
            ]),
        ];
    }
}
