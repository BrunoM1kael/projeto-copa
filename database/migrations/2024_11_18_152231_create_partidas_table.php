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
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adv1')->constrained('times');
            $table->foreignId('adv2')->constrained('times');
            $table->integer('gols1');
            $table->integer('gols2');
            $table->string('resultado')->nullable();
            $table->timestamps();
        });

        Schema::table('times', function (Blueprint $table) {
            $table->unsignedBigInteger('grupo_id')->after('nome');
            $table->foreign('grupo_id')->references('id')->on('grupos');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partidas', function (Blueprint $table) {
            $table->dropForeign(['adv1']);
            $table->dropForeign(['adv2']);
        });
        
        Schema::table('times', function (Blueprint $table) {
            $table->dropForeign(['grupo_id']);
        });
        Schema::dropIfExists('partidas');
    }
};
