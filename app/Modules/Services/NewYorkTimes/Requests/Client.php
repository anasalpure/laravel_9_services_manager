<?php
namespace App\Modules\Services\NewYorkTimes\Requests;

use App\Exceptions\ApiRequestException;

class Client extends BaseClient
{
    public $url = 'articlesearch.json';

    public $allowedParams = [
        'q',
        'begin_date',
        'end_date',
        'sort',
        'page',
    ];

    private $allowedSortBy = [
        "newest", "oldest", "relevance"
    ];


    public function getByKeyword($keyword)
    {
        return $this->get(['q' => $keyword]);
    }

    public function get($params = [])
    {
        foreach($params as $paramName => $paramValue){
            if(!in_array($paramName,$this->allowedParams)){
                throw new ApiRequestException('Parameter '.$paramName.' is not allowed for this endpoint');
            }
        }

        if(isset($params['sort'])){

            if(!in_array($params['sort'],$this->allowedSortBy)){
                throw new ApiRequestException("Unsupported sorting. Allowed sortings are ".implode(", ",$this->allowedSortBy));
            }
        }

        return $this->makeRequest($this->url,$params);
    }


}