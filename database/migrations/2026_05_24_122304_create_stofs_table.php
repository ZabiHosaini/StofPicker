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
        Schema::create('stofs', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('fabrikant_id')
                  ->constrained('fabrikants')
                  ->cascadeOnDelete();
        
            $table->string('name');
            $table->string('categorie');
            $table->integer('prijs');
            $table->string('kleur');
            $table->string('status');
            $table->integer('breed');
            $table->integer('vooraad');
            $table->string('foto');
            $table->text('omschrijving');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stofs');
    }
};
