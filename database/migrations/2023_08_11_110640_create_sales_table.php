<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->foreignId('seller_id')->constrained('users');
            $table->integer('total_amount');
            $table->integer('sub_total');
            $table->smallInteger('payment_method');
            $table->smallInteger('payment_status');
            $table->integer('change_given')->nullable();
            $table->string('notes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
