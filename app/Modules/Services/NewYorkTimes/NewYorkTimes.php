<?php

namespace App\Modules\Services\NewYorkTimes;

use App\Modules\Services\Contracts\IArticleService;
use App\Modules\Services\NewYorkTimes\Requests\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewYorkTimes implements IArticleService {

    public $options = [];
    public static $serviceName = 'New_york_times';

    public function __construct()
    {
        $this->options = [];
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
        if(isset($res->response->docs) && count($res->response->docs )){
            foreach ($res->response->docs as $result) {
                $data = [
                    "title" => $result->abstract,
                    "slug" => Str::slug($result->abstract),
                    "service" => static::$serviceName,
                    "source" => $result->source ,
                    "source_url" => $result->web_url,
                    "content" => json_encode($result->lead_paragraph),
                    "created_at" => $result->pub_date,
                    "image" => $this->getImageOf($result->multimedia),
                    "author" => $result->byline->original ?? null,
                    
                    "tags" => [

                    ]
                ];
                //add tags
                if($result->news_desk){
                    $data["tags"][] = [
                        "title" =>  $result->news_desk,
                        "slug" => Str::slug($result->news_desk),
                    ];
                }

                if($result->section_name){
                    $data["tags"][] = [
                        "title" =>  $result->section_name,
                        "slug" => Str::slug($result->section_name),
                    ];
                }

                if($result->type_of_material){
                    $data["tags"][] = [
                        "title" =>  $result->type_of_material,
                        "slug" => Str::slug($result->type_of_material),
                    ];
                }

                $results [] = $data;
            }

        }
        return $results;
    }

    private function getImageOf($multimedia) {
        if($multimedia && count($multimedia)){
            return $multimedia[0]->url;
        }
        return null;
    }
}