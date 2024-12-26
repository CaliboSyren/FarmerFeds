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
    Schema::create('resource_allocations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('farmer_id')->constrained('farmers')->onDelete('cascade');
        $table->string('resource');
        $table->date('date');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_allocations');
    }
};