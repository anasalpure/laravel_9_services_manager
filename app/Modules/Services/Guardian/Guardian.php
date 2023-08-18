<?php

namespace App\Modules\Services\Guardian;

use App\Modules\Services\Contracts\IArticleService;
use App\Modules\Services\Guardian\Requests\Client;

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


    public function getArticles($keyword)
    {
        return $this->getInstance()->get(array_merge($this->options, [
            'q' => $keyword
        ]));
    }
}