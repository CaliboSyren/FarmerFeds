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
    Schema::create('farmers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->string('phone_number');
        $table->string('gmail_account')->nullable();
        $table->float('land_size');
        $table->date('date');
        $table->timestamps();
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};