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
    Schema::create('hen_stocks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Branch reference
        $table->string('breed'); // Example: "Rhode Island Red"
        $table->integer('quantity'); // Number of hens
        $table->integer('age_weeks'); // Age in weeks
        $table->integer('mortality')->default(0); // Number of hens that died
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hen_stocks');
    }
};
