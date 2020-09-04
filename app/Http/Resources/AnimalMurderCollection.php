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
                ->after('Other')
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
        $merges = [
            'Other' => ['Ass', 'Game', 'Mule'],
            'Camel' => ['Other Camelids'],
        ];
        $animals = $animals->map(function ($animal) use ($animals, $merges) {
            if (!isset($merges[$animal['name']])) {
                return $animal;
            }
            foreach ($merges[$animal['name']] as $name) {
                $animal->resource['value'] += $animals
                    ->where('name', $name)
                    ->where('year', $animal['year'])
                    ->pluck('value')
                    ->sum();
            }

            return $animal;
        });
        $animals = $animals->filter(function ($animal) use ($merges) {
            foreach ($merges as $names) {
                if (in_array($animal['name'], $names)) {
                    return false;
                }
            }

            return true;
        });

        return self::make($animals);
    }
}
