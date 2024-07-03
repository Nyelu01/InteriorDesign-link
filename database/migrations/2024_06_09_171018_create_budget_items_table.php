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
        Schema::create('budget_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price');
            $table->string('total_price');
            $table->unsignedBigInteger('designer_id');
            $table->unsignedBigInteger('requirement_id');
            $table->timestamps();
            $table->foreign('requirement_id')->references('id')->on('design_requirements')->onDelete('cascade');

            $table->foreign('designer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_items');
    }
};
