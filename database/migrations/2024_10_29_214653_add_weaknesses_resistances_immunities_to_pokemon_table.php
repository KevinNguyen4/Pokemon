<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeaknessesResistancesImmunitiesToPokemonTable extends Migration
{
    public function up()
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->json('weaknesses')->nullable();
            $table->json('resistances')->nullable();
            $table->json('immunities')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->dropColumn(['weaknesses', 'resistances', 'immunities']);
        });
    }
}