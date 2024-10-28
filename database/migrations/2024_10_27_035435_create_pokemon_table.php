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
            $table->integer('Ability1');
            $table->integer('Ability2');
            $table->integer('Hidden_Ability');
            $table->integer('Generation');
            $table->integer('Classification');
            $table->integer('Held_Item');
            $table->integer('Common_Moves');
            $table->integer('EV_Spread');
            $table->integer('Weaknesses');
            $table->integer('Resistances');
            $table->integer('Immunities');
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