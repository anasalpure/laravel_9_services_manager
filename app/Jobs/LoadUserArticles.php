<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use App\Modules\Services\Contracts\IArticleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LoadUserArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;
    public IArticleService $service;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->service = app($user->source);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->user->keywords as $keyword) {
            $articlesData = $this->service->getArticles($keyword);
            foreach ($articlesData as $data) {
                $alreadyExist = Article::where('slug',$data['slug'])->first('id');
                if($alreadyExist) continue;
                
                $article = (new Article())->fill($data);
                $article->save();

                if(count($data['tags'])){
                    $tagsIds = [];
                    foreach ($data['tags'] as $tagData) {
                        $tag = Tag::where('slug',$tagData['slug'])->first('id');
                        if(!$tag) {
                            $tag =  Tag::create($tagData);
                        }
                        $tagsIds[] = $tag->id;
                    }

                    $article->tags()->sync($tagsIds);
                }
            }
        }
    }
}
