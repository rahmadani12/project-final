<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::truncate();

        $countries = json_decode(
            file_get_contents(database_path('data/countries.json')),
            true
        );

        foreach ($countries as $item) {

            Country::create([
                'name' => $item['name']['common'] ?? '',
                'code' => $item['cca2'] ?? '',
                'capital' => $item['capital'][0] ?? '',
                'currency' => isset($item['currencies'])
                    ? array_key_first($item['currencies'])
                    : '',
                'region' => $item['region'] ?? '',
                'subregion' => $item['subregion'] ?? '',
                'population' => $item['population'] ?? 0,
                'flag' => $item['flags']['png'] ?? '',
            ]);

        }
    }
}