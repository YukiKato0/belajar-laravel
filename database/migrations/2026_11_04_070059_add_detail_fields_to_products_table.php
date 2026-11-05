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
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->nullable()->unique();
            $table->string('detail_badge')->nullable();
            $table->string('image_url')->nullable();
            $table->json('detail_highlights')->nullable();
            $table->text('file_requirements')->nullable();
            $table->string('template_pdf_url')->nullable();
            $table->string('template_ai_url')->nullable();
            $table->string('template_psd_url')->nullable();
            $table->string('production_time')->nullable();
            $table->unsignedInteger('minimum_order')->default(1);
            $table->unsignedInteger('sold_count')->default(0);
            $table->json('configuration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['sku']);
            $table->dropColumn([
                'sku',
                'detail_badge',
                'image_url',
                'detail_highlights',
                'file_requirements',
                'template_pdf_url',
                'template_ai_url',
                'template_psd_url',
                'production_time',
                'minimum_order',
                'sold_count',
                'configuration',
            ]);
        });
    }
};
