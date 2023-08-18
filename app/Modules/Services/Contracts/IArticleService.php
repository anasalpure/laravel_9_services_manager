<?php
namespace App\Modules\Services\Contracts;

interface IArticleService{
    public function getInstance();
    public function getArticles($keyword);
}