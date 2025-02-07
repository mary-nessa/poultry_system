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
    Schema::create('egg_collections', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Branch reference
        $table->date('date'); // Collection date
        $table->integer('total_collected'); // Total eggs collected
        $table->integer('breakages')->default(0); // Number of broken eggs
        $table->integer('losses')->default(0); // Eggs lost for any reason
        $table->integer('transferred')->default(0); // Eggs transferred to another branch
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_collections');
    }
};
