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
        Schema::create('vaccins', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('type', ['obligatoire', 'recommande', 'optionnel']);
            $table->integer('doses_possibles')->default(1);
            $table->boolean('actif')->default(true);
            $table->timestamps();
            
            $table->index('nom');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccins');
    }
};
