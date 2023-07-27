<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
            $table->foreignIdFor(\App\Models\Order::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->float('price');
            $table->float('discount');
            $table->integer('quantity');
            $table->string('content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
