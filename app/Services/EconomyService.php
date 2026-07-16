<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EconomyService
{
    protected $baseUrl = 'https://api.worldbank.org/v2';

    /**
     * Mengambil satu indikator berdasarkan ISO3 negara
     */
    public function getIndicator($iso3, $indicator)
    {
        $response = Http::get(
            "{$this->baseUrl}/country/{$iso3}/indicator/{$indicator}",
            [
                'format' => 'json',
                'mrnev' => 1
            ]
        );

        if (!$response->successful()) {
            return null;
        }

        $json = $response->json();

        if (!isset($json[1][0]['value'])) {
            return null;
        }

        return [
            'value' => $json[1][0]['value'],
            'year'  => $json[1][0]['date']
        ];
    }

    /**
     * Mengambil seluruh data ekonomi
     */
    public function getEconomy($iso3)
    {
        $gdp = $this->getIndicator($iso3, 'NY.GDP.MKTP.CD');
        $growth = $this->getIndicator($iso3, 'NY.GDP.MKTP.KD.ZG');
        $inflation = $this->getIndicator($iso3, 'FP.CPI.TOTL.ZG');
        $unemployment = $this->getIndicator($iso3, 'SL.UEM.TOTL.ZS');

        return [

            'year' => $gdp['year'] ?? date('Y'),

            'gdp' => $gdp['value'] ?? 0,

            'growth' => $growth['value'] ?? 0,

            'inflation' => $inflation['value'] ?? 0,

            'unemployment' => $unemployment['value'] ?? 0,

            // Belum disediakan oleh World Bank pada implementasi ini
            'export_value' => 0,

            'import_value' => 0,
        ];
    }
}