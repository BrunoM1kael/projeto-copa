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
        Schema::Table('classificacao', function (Blueprint $table) {
            $table->integer('GM')->after('derrota');
            $table->integer('GC')->after('GM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::Table('classificacao', function (Blueprint $table) {
            $table->dropColumn('GM');
            $table->dropColumn('GC');
        });
    }
};