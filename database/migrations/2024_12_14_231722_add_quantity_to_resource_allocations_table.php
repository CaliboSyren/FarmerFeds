<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('resource_allocations', function (Blueprint $table) {
            $table->integer('quantity')->after('resource')->default(1); // Add 'quantity' column
        });
    }

    public function down()
    {
        Schema::table('resource_allocations', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Remove 'quantity' column
        });
    }
};
