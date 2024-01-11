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
        Schema::create('classement', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_id');
            $table->unsignedBigInteger('athlete_id');
            $table->foreign('athlete_id')->references('id')->on('athletes')
                ->onDelete('cascade');
            $table->foreign('sport_id')->references('id')->on('sports')
                ->onDelete('cascade');
            $table->integer('rang');
            $table->string('performance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classement');
    }
};
