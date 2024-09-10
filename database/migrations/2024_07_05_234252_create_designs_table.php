<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('de_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('slug')->unique();
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('order')->default(0)->unsigned();
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('de_products_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 60);
            $table->integer('order')->default(0)->unsigned();
        });

        Schema::create('de_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('symbol', 10);
            $table->tinyInteger('is_prefix_symbol')->unsigned()->default(0);
            $table->integer('order')->default(0)->unsigned();
            $table->tinyInteger('decimals')->unsigned()->default(0);
            $table->tinyInteger('is_default')->default(0);
            $table->double('exchange_rate')->default(1);
            $table->timestamps();
        });

        Schema::create('de_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->string('slug')->unique();
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->text('images')->nullable();
            $table->integer('square')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->enum('moderation_status', ['draft', 'published', 'pending'])->default('published');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('currency_id')->references('id')->on('de_currencies')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('de_categories')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('de_products_types')->onDelete('cascade');
        });


        Schema::create('de_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('reviewable_id');
            $table->string('reviewable_type');
            $table->float('star');
            $table->text('comment');
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('de_reviews');
        Schema::dropIfExists('de_products');
        Schema::dropIfExists('de_products_types');
        Schema::dropIfExists('de_categories');
        Schema::dropIfExists('de_currencies');
    }
};
