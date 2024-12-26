<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()

    {

        Schema::create('user_registrations', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->string('location');

            $table->string('phone_number')->unique(); // Make phone_number unique

            $table->string('gmail_account')->nullable()->unique(); // Make gmail_account unique

            $table->decimal('land_size', 8, 2);

            $table->date('date_of_registration');

            $table->timestamps();

        });

    }


    public function down()

    {

        Schema::dropIfExists('user_registrations');

    }
};
