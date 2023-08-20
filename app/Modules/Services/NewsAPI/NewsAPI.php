<?php

namespace App\Modules\Services\NewsAPI;

use App\Modules\Services\Contracts\IArticleService;
use App\Modules\Services\NewsAPI\Requests\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class NewsAPI implements IArticleService {

    public $options = [];
    public static $serviceName = 'newsapi';

    public function __construct()
    {
        $this->options = [
            'language' => 'en',
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

        if($res->articles){
            foreach ($res->articles as $result) {
                $results [] = [
                    "title" => $result->title,
                    "slug" => Str::slug($result->title),
                    "service" => static::$serviceName,
                    "source" => $result->source->name ?? '' ,
                    "source_url" => $result->url,
                    "content" => json_encode($result->description),
                    "created_at" => $result->publishedAt,
                    "image" => $result->urlToImage,
                    "author" => $result->author ?? null,
                    
                    "tags" => [

                    ]
                ];
            }

        }
        return $results;
    }
}