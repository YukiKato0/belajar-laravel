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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category', 100)->default('Product');
            $table->text('excerpt');
            $table->string('author_name')->default('Tim PrimaGraphia');
            $table->string('author_image_url', 2048)->nullable();
            $table->string('featured_image_url', 2048)->nullable();
            $table->longText('content');
            $table->unsignedSmallInteger('read_time')->default(1);
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
