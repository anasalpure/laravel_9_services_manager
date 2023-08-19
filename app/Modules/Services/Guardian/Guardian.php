<?php

namespace App\Modules\Services\Guardian;

use App\Modules\Services\Contracts\IArticleService;
use App\Modules\Services\Guardian\Requests\Client;
use Illuminate\Support\Str;
class Guardian implements IArticleService {

    public $options = [];

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
        return $this->getInstance()->get(array_merge($this->options, [
            'q' => $keyword
        ]));
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
                    "service" => 'guardian',
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