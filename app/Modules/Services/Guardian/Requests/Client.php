<?php
/**
 * https://open-platform.theguardian.com/documentation/search
 */
namespace App\Modules\Services\Guardian\Requests;

use App\Exceptions\ApiRequestException;

class Client extends BaseClient
{
    public $url = 'search';

    public $allowedParams = [
        'q',
        'lang',
        'tag',
        'from-date',
        'to-date',
        'page-size',
        'page',
        'order-by',
    ];

    private $allowedSortBy = [
        'newest', 'oldest', 'relevance'
    ];

    public function get($params = [])
    {
        foreach($params as $paramName => $paramValue){
            if(!in_array($paramName,$this->allowedParams)){
                throw new ApiRequestException('Parameter '.$paramName.' is not allowed for this endpoint');
            }
        }

        if(isset($params['sortBy'])){

            if(!in_array($params['sortBy'],$this->allowedSortBy)){
                throw new ApiRequestException("Unsupported sorting. Allowed sortings are ".implode(", ",$this->allowedSortBy));
            }
        }

        return $this->makeRequest($this->url,$params);
    }


}