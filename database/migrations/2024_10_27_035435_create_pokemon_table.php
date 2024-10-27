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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('ID');
            $table->string('Name');
            $table->string('Form');
            $table->string('Type1');
            $table->string('Type2');
            $table->integer('Total_Stats');
            $table->integer('HP');
            $table->integer('Attack');
            $table->integer('Defense');
            $table->integer('Sp_Atk');
            $table->integer('Sp_Def');
            $table->integer('Speed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
