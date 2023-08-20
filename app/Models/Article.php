<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "service",
        "source",
        "source_url",
        "content",
        "is_published",
        "views",
        "image",
        "author"
    ];

    /**
     * Article has many tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function search($request) {
        $query = $request->get('q');
        $userCategories = $request->user()->categories ?? [];

        return Article::query()->latest()
        ->when(!empty($query),function ($q) use($query) {
            $q->where('title','LIKE',"%$query%");
        })
        ->when(count($userCategories),function ($q) use($query,$userCategories) {
            $q->whereHas('tags',function($tag) use($userCategories) {
                foreach ($userCategories as $category) {
                    if($category){
                        $tag->where('title','LIKE',"%$category%");
                    }
                }
            });
        });
    }

}
