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
        Schema::create('percentage_direct_sales_commission', function (Blueprint $table) {
            $table->id();
            $table->float('percent_from', 2)->nullable();
            $table->float('percent_to', 2)->nullable();
            $table->float('seller_percentage', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('percentage_direct_sales_commission');
    }
};
