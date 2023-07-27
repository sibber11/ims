<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->unique();
            $table->string('key');
            $table->string('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_meta');
    }
};
