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
        Schema::table('users', function(Blueprint $table) {
            $table->unsignedBigInteger('department_id')->after('master');
            $table->unsignedBigInteger('position_id')->after('master');

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);

            $table->dropColumn(['department_id', 'position_id']);
        });
    }
};
