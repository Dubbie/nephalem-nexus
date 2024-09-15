<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $with = ['prerequisites'];

    public function prerequisites()
    {
        return $this->hasMany(SkillPrerequisite::class);
    }

    public function skillCategory()
    {
        return $this->belongsTo(SkillCategory::class);
    }

    public function diabloClass()
    {
        return $this->hasOneThrough(
            DiabloClass::class,  // The final model you want to reach
            SkillCategory::class, // The intermediate model
            'id',                 // Foreign key on the SkillCategory table
            'id',                 // Foreign key on the DiabloClass table
            'skill_category_id',   // Local key on the Skill model (SkillCategory's foreign key in Skill)
            'diablo_class_id'      // Local key on the SkillCategory model (DiabloClass's foreign key in SkillCategory)
        );
    }
}
