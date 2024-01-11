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
        Schema::create('sports', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable(false);
            $table->string('description')->nullable(false);
            $table->integer('annee_ajout')->nullable(false);
            $table->integer('nb_disciplines')->nullable(false);
            $table->integer('nb_epreuves')->nullable(false);
            $table->dateTime('date_debut')->nullable(false);
            $table->dateTime('date_fin')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('url_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports');
    }
};
