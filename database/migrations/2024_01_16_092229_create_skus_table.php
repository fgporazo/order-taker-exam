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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->float('unit_price');
            $table->string('image');
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
        Schema::dropIfExists('skus');
    }
};
