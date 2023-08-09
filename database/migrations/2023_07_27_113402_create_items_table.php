<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
            $table->foreignIdFor(\App\Models\Brand::class)->constrained();
            $table->foreignId('supplier_id')->constrained('users');
            $table->foreignIdFor(\App\Models\Order::class)->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->float('retail_price');
            $table->float('discount')->default(0);
            $table->float('price');
            $table->integer('quantity_received');
            $table->integer('defective')->default(0);
            $table->integer('stock');
            $table->integer('sold')->default(0);
            $table->integer('available')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
