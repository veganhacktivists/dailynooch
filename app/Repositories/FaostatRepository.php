<?php

namespace App\Repositories;

use App\Http\Resources\AnimalMurderCollection;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FaostatRepository
{
    private const API_URL = 'http://fenixservices.fao.org/faostat/api/%s/en/data/%s';
    private const API_VERSION = 'v1';
    private const API_ENDPOINT = 'QL';

    private const API_LIST = '>';

    private const YEAR_START = 1961;
    private const ELEMENTS_SLAUGHTERED = 2313;
    private const REGION_WORLD = 5000;
    private const ITEM_MEAT_TOTAL = 1765;

    public function all(): AnimalMurderCollection
    {
        $response = $this->get(self::API_ENDPOINT, [
            'area' => self::REGION_WORLD,
            'element' => self::ELEMENTS_SLAUGHTERED,
            'item' => self::ITEM_MEAT_TOTAL . self::API_LIST,
            'year' => implode(',', range(self::YEAR_START, now()->year)),
        ]);

        return AnimalMurderCollection::fromFaostat($response['data']);
    }

    private function get(string $endpoint, array $query): Response
    {
        $response = Http::get(vsprintf(self::API_URL, [
            self::API_VERSION,
            $endpoint,
        ]), $query);
        $this->validateOrFail($response);

        return $response;
    }

    private function validateOrFail(Response $response): void
    {
        if (!$response->successful()) {
            throw new Exception("FAOSTAT returned a {$response->status()} error code.");
        }
        if (!isset($response['data'])) {
            throw new Exception('FAOSTAT\'s response format has changed and cannot be processed.');
        }
    }
}
