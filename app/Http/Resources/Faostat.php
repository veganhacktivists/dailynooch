<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Faostat extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->resource;

        $resource['Item'] = (string) Str::of($resource['Item'])
            ->after('Meat,')
            ->title()
            ->trim();

        // The unit is either "Head" (1 animal) or "1000 Head" (1000 animals).
        $resource['Unit'] = (int) (string) Str::of($resource['Unit'])
            ->before('Head')
            ->trim()
            ->whenEmpty(function () {
                return 1;
            });

        $resource['Value'] = (int) $resource['Value'] * $resource['Unit'];
        $resource['Unit'] = 1;

        $resource['Year'] = (int) $resource['Year'];

        return [
            'item' => $resource['Item'],
            'value' => $resource['Value'],
            'year' => $resource['Year'],
        ];
    }
}
