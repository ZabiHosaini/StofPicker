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
        Schema::create('kledings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('geslacht', ['Heren', 'Dames', 'Kids']);
            $table->integer('prijs');
            $table->text('omschrijving');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kledings');
    }
};
