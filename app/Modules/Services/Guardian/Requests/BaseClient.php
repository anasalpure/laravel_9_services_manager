<?php

namespace App\Modules\Services\Guardian\Requests;

use App\Exceptions\ApiRequestException;
use GuzzleHttp\Client as Client;

class BaseClient {

    /* @var $client Client */
    protected $client;

    protected $apiKey;
    protected $pageSize = 100;
    protected $page = 1;
    
    public function __construct()
    {
        $options = [
            'base_uri'  => 'https://content.guardianapis.com/',
        ];
        $this->client = new Client($options);

        $this->apiKey = config('Apis.guardian.key');
        if(empty($this->apiKey))
        {
            throw new \InvalidArgumentException('No API key set');
        }
    }

    protected function makeRequest($url,$params = [])
    {
        $query = [
            'api-key' => $this->apiKey,
            'page-size' => $this->pageSize,
            'page' => $this->page
        ];

        $query = array_merge($query,$params);

        $response = $this->client->get($url, ['query' => $query]);

        $body = json_decode($response->getBody()->getContents());

        if(property_exists($body, 'error'))
        {
            if(is_object($body->error))
            {
                throw new ApiRequestException($body->error->message, $body->error->code);
            }
            else
            {
                throw new ApiRequestException($body->error, 500);
            }

            return $response;
        }

        return $body;
    }

    /**
     * @param $pageSize - The number of results to return per page (request). 20 is the default, 100 is the maximum.
     * @return GuardianClient
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * @param $page - Use this to page through the results if the total results found is greater than the page size.
     * @return GuardianClient
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }
}