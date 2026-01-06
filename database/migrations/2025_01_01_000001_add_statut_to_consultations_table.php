<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->string('type_consultation')->after('date_consultation');
            $table->enum('statut', ['valide', 'annule'])->default('valide')->after('notes');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn(['type_consultation', 'statut']);
            $table->dropSoftDeletes();
        });
    }
};