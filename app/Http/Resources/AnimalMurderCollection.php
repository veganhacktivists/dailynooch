<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class AnimalMurderCollection extends ResourceCollection
{
    public static function fromFaostat(array $data): self
    {
        $animals = collect($data);

        $animals = $animals->map(function ($animal) {
            $name = (string) Str::of($animal['Item'])
                ->after('Meat,')
                ->replace('Meat', 'Other')
                ->before('and')
                ->before('nes')
                ->title()
                ->trim();

            $unit = (int) (string) Str::of($animal['Unit'])
                ->before('Head')
                ->trim()
                ->whenEmpty(function () {
                    return 1;
                });

            return JsonResource::make([
                'name' => $name,
                'value' => (int) $animal['Value'] * $unit,
                'year' => (int) $animal['Year'],
            ]);
        });

        // Merge camels and other camelids.

        $animals = $animals->map(function ($animal) use ($animals) {
            switch ($animal['name']) {
                case 'Camel':
                    $animal->resource['value'] += $animals
                        ->where('name', 'Other Camelids')
                        ->where('year', $animal['year'])
                        ->pluck('value')
                        ->sum();
                    return $animal;
                default:
                    return $animal;
            }
        });
        $animals = $animals->filter(function ($animal) {
            switch ($animal['name']) {
                case 'Other Camelids':
                    return false;
            }
            return true;
        });

        return self::make($animals);
    }
}
