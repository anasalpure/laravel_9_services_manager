<?php

namespace App\Modules\Services\NewsAPI;

use App\Modules\Services\Contracts\IArticleService;
use App\Modules\Services\NewsAPI\Requests\Client;

class NewsAPI implements IArticleService {

    public $options = [];

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
        return $this->getInstance()->get(array_merge($this->options, [
            'q' => $keyword
        ]));
    }

    public function getArticles($keyword)
    {
        $res = $this->loadArticles($keyword);
        dd($res);
    }
}