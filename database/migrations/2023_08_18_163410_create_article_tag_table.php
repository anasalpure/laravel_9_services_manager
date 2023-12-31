<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId("article_id");
            $table->foreignId("tag_id");
            $table
                ->foreign("article_id")
                ->references("id")
                ->on("articles")
                ->onDelete("cascade")
                ->onUpdate("restrict");
            $table
                ->foreign("tag_id")
                ->references("id")
                ->on("tags")
                ->onDelete("cascade")
                ->onUpdate("restrict");
            $table->unique(["article_id", "tag_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
};
