<?php

namespace App\Repositories;

use App\Http\Resources\PopulationCollection;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WorldBankRepository
{
    private const URL_COUNTRY_INDICATOR = 'https://api.worldbank.org/v2/country/%s/indicator/%s';

    public const COUNTRY_WORLD = '1W';
    public const INDICATOR_POPULATION_TOTAL = 'SP.POP.TOTL';

    public function population(): PopulationCollection
    {
        $response = Http::get(vsprintf(self::URL_COUNTRY_INDICATOR, [
            self::COUNTRY_WORLD,
            self::INDICATOR_POPULATION_TOTAL,
        ]), [
            'format' => 'json',
            'per_page' => 1000,
        ]);
        $this->validateOrFail($response);

        return PopulationCollection::fromWorldBank($response[1]);
    }

    private function validateOrFail(Response $response): void
    {
        if (!$response->successful()) {
            throw new Exception("FAOSTAT returned a {$response->status()} error code.");
        }
        if (!isset($response[1])) {
            throw new Exception('Expected population contain two fields.');
        }
        foreach ($response[1] as $i => $row) {
            if (!isset($row['country']) || !isset($row['country']['value'])) {
                throw new Exception("Expected row {$i} to have a country value.");
            }
            if (!isset($row['date']) || !isset($row['value'])) {
                throw new Exception("Expected row {$i} to have date and value.");
            }
        }
    }
}
