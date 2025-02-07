<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Link revenue to a branch
            $table->enum('product_type', ['eggs', 'hens', 'other']); // Product type sold
            $table->integer('quantity'); // Quantity sold
            $table->decimal('price_per_unit', 10, 2); // Price per unit sold
            $table->decimal('total_revenue', 10, 2); // Calculated as quantity * price_per_unit
            $table->date('sale_date'); // Sale date
            $table->text('description')->nullable(); // Optional details
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('revenues');
    }
}
