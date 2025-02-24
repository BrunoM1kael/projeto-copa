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
        Schema::create('classificacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->unsignedBigInteger('times_id');
            $table->foreign('times_id')->references('id')->on('times');

            $table->integer('vitoria')->default(0);
            $table->integer('empate')->default(0);
            $table->integer('derrota')->default(0);
            $table->integer('saldo_gols')->default(0);
            $table->integer('pontos')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classificacao', function (Blueprint $table) {
            $table->dropForeign(['grupo_id']);
            $table->dropForeign(['times_id']);
        });
    
        Schema::dropIfExists('classificacao');
    }
};
