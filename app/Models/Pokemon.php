<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'name', 'type1', 'type2', 'total', 'hp', 'attack', 'defense', 'sp_atk', 'sp_def', 'speed', 
        'weaknesses', 'resistances', 'immunities', 'ability1', 'ability2', 'hiddenAbility', 
        'items', 'moves', 'popular_ability'
    ];
}