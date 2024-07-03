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
        Schema::create('design_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->string('project_type');
            $table->string('project_location');
            $table->string('project_grade');
            $table->text('description');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_requirements');
    }
};
