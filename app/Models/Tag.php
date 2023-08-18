<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "content",
        "is_published"
    ];



    /**
     * Tag has many Articles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class)
            ->withTimestamps();
    }
}
