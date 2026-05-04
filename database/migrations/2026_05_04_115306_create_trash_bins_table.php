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
    Schema::create('trash_bins', function (Blueprint $table) {
        $table->id();
        $table->string('lokasi'); 
        $table->integer('kapasitas_persen'); 
        $table->string('status'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_bins');
    }
};
