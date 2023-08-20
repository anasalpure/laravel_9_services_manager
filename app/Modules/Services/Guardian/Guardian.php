<?php

namespace App\Modules\Services\Guardian;

use App\Modules\Services\Contracts\IArticleService;
use App\Modules\Services\Guardian\Requests\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class Guardian implements IArticleService {

    public $options = [];
    public static $serviceName = 'guardian';

    public function __construct()
    {
        $this->options = [
            'lang' => 'en',
        ];
    }

    public function getInstance()
    {
        return new Client();
    }

    
    public function loadArticles($keyword)
    {
        Log::stack(["service"])->info(static::$serviceName . " - searching for : " . $keyword . "...");
        try {
            $response =  $this->getInstance()->get(array_merge($this->options, [
                'q' => $keyword
            ]));
        } catch (\Throwable $th) {
            Log::stack(["service"])->info(static::$serviceName . " - Error for : " . $keyword . "...");
            Log::stack(["service"])->error(static::$serviceName . $th->getMessage());
        }


        return $response;
    }

    public function getArticles($keyword)
    {
        $results = [];
        $res = $this->loadArticles($keyword);
        if($res->response && $res->response->results){
            foreach ($res->response->results as $result) {
                $results [] = [
                    "title" => $result->webTitle,
                    "slug" => Str::slug($result->webTitle),
                    "service" => static::$serviceName,
                    "source" => $result->sectionName,
                    "source_url" => $result->webUrl,
                    // "content" => '',
                    "created_at" => $result->webPublicationDate,
                    "tags" => [
                       [
                        "title" =>  $result->pillarName,
                        "slug" => Str::slug($result->pillarName),
                       ] 
                    ]
                ];
            }

        }
        return $results;
    }
}