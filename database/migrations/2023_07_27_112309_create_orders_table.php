<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->smallInteger('type');
            $table->smallInteger('status');
            $table->float('sub_total');
            $table->float('item_discount');
            $table->float('tax');
            $table->float('shipping')->nullable();
            $table->float('total');
            $table->string('promo')->nullable();
            $table->float('promo_discount')->nullable();
            $table->float('grand_total');
            $table->string('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
