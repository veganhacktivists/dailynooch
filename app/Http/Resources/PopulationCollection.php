<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PopulationCollection extends ResourceCollection
{
    public static function fromWorldBank($populations)
    {
        $populations = collect($populations);
        $populations = $populations->map(function ($population) {
            return JsonResource::make([
                'country' => $population['country']['value'],
                'value' => $population['value'],
                'year' => $population['date'],
            ]);
        });

        return self::make($populations);
    }
}
