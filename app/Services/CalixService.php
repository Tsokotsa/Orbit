<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CalixService
{
    protected string $host;
    protected string $user;
    protected string $password;

    public function __construct()
    {
        $this->host = config('services.calix.host', env('CALIX_HOST'));
        $this->user = config('services.calix.user', env('CALIX_USER'));
        $this->password = config('services.calix.password', env('CALIX_PASSWORD'));
    }

    /**
     * Make GET request with optional query parameters
     */
    public function get(string $endpoint, array $params = [])
    {
        $url = $this->host . $endpoint;

        return Http::withBasicAuth($this->user, $this->password)
            ->accept('application/json')
            ->withOptions(['verify' => false, 'timeout' => 30])
            ->get($this->host . $endpoint, $params)
            ->throw()
            ->json();
    }

    /**
     * Fetch GUI variables (with offset/limit)
     */
    public function getGuiVariable(
        //string $variableName, // the dynamic part in the URL
        $variableName = "Maputo",
        int $offset = 0,
        int $limit = 20
    ) {
        $endpoint = "/rest/v1/config/device/gui/{$variableName}";

        $params = [
            'offset' => $offset,
            'limit' => $limit,
        ];

        return $this->get($endpoint, $params);
    }


}



