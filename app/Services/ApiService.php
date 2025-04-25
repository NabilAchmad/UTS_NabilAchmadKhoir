<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiService{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env("RAPID_KEY");
    }

    public function getMovie($query){
        try {
            $response = $this->client->request('GET', 'https://movies-ratings2.p.rapidapi.com/ratings?id=tt0111161', [ 'headers' => ['x-rapidapi-key' => $this->apiKey], 'verify' => false]);
            $data = json_decode($response->getbody()->getContents(), true);
            return $data;
        }
        catch(requestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}