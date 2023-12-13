<?php

namespace App\Service;

use CurlHandle;

class CurlService
{
    private string $endpoint;
    private CurlHandle $ch;

    function __construct(string $url)
    {
        $this->endpoint = $url;
        $this->ch = curl_init($url);
    }

    public function info (): mixed 
    {
        return curl_getinfo($this->ch); 
    }

    public function setOptions(
        string $method = 'GET',
        array $headers = null,
        array $params = null
    ): void {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($headers) curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        if (($query = http_build_query($params))) curl_setopt($this->ch, CURLOPT_URL, $this->endpoint . '?' . $query);
    }

    public function execute(): string
    {
        return curl_exec($this->ch);
    }
}
