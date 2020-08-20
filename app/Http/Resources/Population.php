<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Population extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'country' => $this->resource['country']['value'],
            'value' => $this->resource['value'],
            'year' => $this->resource['date'],
        ];
    }
}
