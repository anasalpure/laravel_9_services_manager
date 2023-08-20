<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'service' => $this->service,
            'source' => $this->source,
            'source_url' => $this->source_url,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'views' => $this->views,
            'image' => $this->image,
            'date' => $this->created_at->format('l d F H:i'),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
