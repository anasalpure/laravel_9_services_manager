<?php

namespace App\Modules\Services\NewsAPI;

use App\Modules\Services\NewsAPI\Requests\Client;

class NewsAPI {

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


    public function getArticles($keyword)
    {
        return $this->getInstance()->get(array_merge($this->options, [
            'q' => $keyword
        ]));
    }
}