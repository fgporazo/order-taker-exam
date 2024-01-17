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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('date_of_delivery');
            $table->enum('status',['New','Completed','Cancelled'])->default('New');
            $table->float('amount_due');
            $table->timestamp('date_created');
            $table->string('created_by');
            $table->timestamp('timestamp');
            $table->integer('user_id');
            $table->boolean('is_active')->default(TRUE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
