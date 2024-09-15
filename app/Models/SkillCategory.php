<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_id',
    ];

    public function skills()
    {
        return $this->hasManyThrough(Skill::class, SkillCategory::class, 'id', 'skill_category_id');
    }

    public function diabloClass()
    {
        return $this->belongsTo(DiabloClass::class, 'class_id');
    }
}
