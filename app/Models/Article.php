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
        "image"
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
        
        return Article::query()
        ->when(!empty($query),function ($q) use($query) {
            $q->where('title','LIKE',"%$query%");
        });
    }
}
