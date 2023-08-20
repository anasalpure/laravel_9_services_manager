<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::search($request)
            ->limit(50)
            ->get();
        return ArticleResource::collection($articles);
    }
}
