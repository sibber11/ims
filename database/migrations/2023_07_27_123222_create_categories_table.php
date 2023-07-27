<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->string('content')->nullable();
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
            $table->nestedSet();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_product');
    }
};
