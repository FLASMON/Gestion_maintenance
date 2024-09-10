<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->string('icon', 60)->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
//            $table->string('slug', 120);
            $table->string('slug')->unique();
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

//        Schema::create('posts', function (Blueprint $table) {
//            $table->id();
//            $table->string('name', 255);
//            $table->string('description', 400)->nullable();
//            $table->longText('content')->nullable();
//            $table->string('status', 60)->default('published');
//            $table->tinyInteger('is_featured')->unsigned()->default(0);
//            $table->string('image', 255)->nullable();
//            $table->integer('views')->unsigned()->default(0);
//            $table->string('format_type', 30)->nullable();
//            $table->timestamps();
//        });

//        Schema::create('post_tag', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('post_id');
//            $table->unsignedBigInteger('tag_id');
//            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
//            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
//            $table->timestamps();
//        });

//        Schema::create('post_categories', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('post_id');
//            $table->unsignedBigInteger('category_id');
//            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
//            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::dropIfExists('post_categories');
//        Schema::dropIfExists('post_tag');
//        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tags');
    }
};
