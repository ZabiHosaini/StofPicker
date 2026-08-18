<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('size_chart_sizes', function (Blueprint $table) {
            $table->id();
    
            $table->unsignedBigInteger('size_chart_id');
    
            $table->string('size');
    
            $table->decimal('chest_min', 5, 2)->nullable();
            $table->decimal('chest_max', 5, 2)->nullable();
    
            $table->decimal('waist_min', 5, 2)->nullable();
            $table->decimal('waist_max', 5, 2)->nullable();
    
            $table->decimal('hips_min', 5, 2)->nullable();
            $table->decimal('hips_max', 5, 2)->nullable();
    
            $table->decimal('body_length_min', 5, 2)->nullable();
            $table->decimal('body_length_max', 5, 2)->nullable();
    
            $table->decimal('shoulder_min', 5, 2)->nullable();
            $table->decimal('shoulder_max', 5, 2)->nullable();
    
            $table->decimal('sleeve_length_min', 5, 2)->nullable();
            $table->decimal('sleeve_length_max', 5, 2)->nullable();
    
            $table->decimal('inseam_min', 5, 2)->nullable();
            $table->decimal('inseam_max', 5, 2)->nullable();
    
            $table->timestamps();
    
            $table->foreign('size_chart_id')
                ->references('id')
                ->on('size_charts')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('size_chart_sizes');
    }
};