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
    Schema::create('stocks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade');
        $table->string('item_type'); // 'feed' or 'medication'
        $table->integer('quantity'); // Remaining stock
        $table->integer('low_stock_threshold')->default(10); // Alert threshold
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
