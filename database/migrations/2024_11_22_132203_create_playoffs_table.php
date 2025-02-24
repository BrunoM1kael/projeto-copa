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
        Schema::create('playoffs', function (Blueprint $table) {
            $table->id();
            $table->string('fase');
            $table->foreignId('adv1')->constrained('times');
            $table->foreignId('adv2')->constrained('times');
            $table->integer('gols1')->default(0);
            $table->integer('gols2')->default(0);
            $table->string('penaltis')->default(0);
            $table->string('resultado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('playoffs', function (Blueprint $table) {
            $table->dropForeign(['adv1']);
            $table->dropForeign(['adv2']);
        });

        Schema::dropIfExists('playoffs');
    }
};
