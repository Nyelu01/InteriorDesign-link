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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('pdf_path');
            $table->unsignedBigInteger('designer_id');
            $table->unsignedBigInteger('requirement_id'); // Add requirement_id column
            // $table->unsignedBigInteger('client_id');
            $table->timestamps();

            // $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('designer_id')->references('id')->on('users')->onDelete('cascade');
            // Add foreign key constraint for requirement_id
            $table->foreign('requirement_id')->references('id')->on('design_requirements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
