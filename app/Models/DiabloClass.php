<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiabloClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'strength',
        'dexterity',
        'vitality',
        'energy'
    ];

    public function skillCategories()
    {
        return $this->hasMany(SkillCategory::class);
    }
}
