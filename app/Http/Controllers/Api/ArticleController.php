<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        return ArticleResource::collection(Article::all());
    }
}
