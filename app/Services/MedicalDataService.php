<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MedicalDataService
{
    protected string $DT_ID;
    protected string $URL;

    public function __construct(string $dt_id, string $url="https://www.gov.il/he/api/DataGovProxy/GetDGResults")
    {
        $this->DT_ID = $dt_id;
        $this->URL = $url;
    }

    public function getData(int $page, $withTotalCount=false)
    {
        $requestObj = [
            "DynamicTemplateID" => "{$this->DT_ID}",
            "From" => "".($page * 10),
            "QueryFilters" => [
                "skip" => [
                    "Query" => "".($page * 10)
                ]
            ]
        ];

        $response = Http::post($this->URL, $requestObj);

        if ($response->status() == 200 && $response->json()) {
            $data = $response->json();
            if ($withTotalCount) {
                $total = intval($data['TotalResults']);
                return [$data['Results'], $total];
            }
            return $data['Results'];
        }

        return null;
    }
}