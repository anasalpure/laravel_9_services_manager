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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->string("service");
            $table->string("source")->nullable();
            $table->string("source_url",400)->nullable();
            $table->json("content")->nullable();
            $table->boolean("is_published")->default(true);
            $table->bigInteger("views")->default(0);
            $table->string("image",400)->nullable();
            $table->string("author")->nullable();
            
            $table->unique("slug");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
