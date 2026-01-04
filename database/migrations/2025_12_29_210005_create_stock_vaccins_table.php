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
        Schema::create('stock_vaccins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccin_id')->constrained()->onDelete('cascade');
            $table->integer('quantite_recue');
            $table->integer('quantite_utilisee')->default(0);
            $table->string('source');
            $table->date('date_reception');
            $table->string('lot')->nullable();
            $table->date('date_expiration')->nullable();
            $table->timestamps();
            
            $table->index(['vaccin_id', 'date_reception']);
            $table->index('date_expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_vaccins');
    }
};
