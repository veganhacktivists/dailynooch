<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
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
        $animals = self::mergeAnimals($animals, 'Other', ['Ass', 'Game', 'Mule']);
        $animals = self::mergeAnimals($animals, 'Camel', ['Other Camelids']);

        return self::make($animals);
    }

    private static function mergeAnimals(Collection $animals, string $from, array $to): Collection
    {
        $animals = $animals->map(function ($animal) use ($from, $to, $animals) {
            if ($animal['name'] !== $from) {
                return $animal;
            }
            foreach ($to as $name) {
                $animal->resource['value'] += $animals
                    ->where('name', $name)
                    ->where('year', $animal['year'])
                    ->pluck('value')
                    ->sum();
            }

            return $animal;
        });
        $animals = $animals->filter(function ($animal) use ($from, $to) {
            return !in_array($animal['name'], $to);
        });

        return $animals;
    }
}
