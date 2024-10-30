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
            $table->integer('Number'); //Done
            $table->string('Name'); //Done
            $table->string('Form'); //idk if needed, form is in the name, but a little weird
            $table->string('Type1'); //Done
            $table->string('Type2')->nullable(); //Done
            $table->integer('Total_Stats'); //Done
            $table->integer('HP'); //Done
            $table->integer('Attack'); //Done
            $table->integer('Defense'); //Done
            $table->integer('Sp_Atk'); //Done
            $table->integer('Sp_Def'); //Done
            $table->integer('Speed'); //Done

            //cue off of primary key(Number/Name) to match these
            $table->string('Ability1');
            $table->string('Ability2')->nullable();
            $table->string('Hidden_Ability')->nullable();
            $table->integer('Generation');
            $table->string('Classification')->nullable();
            $table->string('Held_Item')->nullable();
            $table->string('Common_Moves')->nullable();
            $table->string('EV_Spread')->nullable();
            $table->json('weaknesses')->nullable();
            $table->json('resistances')->nullable();
            $table->json('immunities')->nullable();
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