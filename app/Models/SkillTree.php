<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillTree extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'base_skills'
    ];

    protected $casts = [
        'base_skills' => 'array'
    ];

    protected $with = [
        'skillChanges'
    ];

    public function skillChanges()
    {
        return $this->hasMany(SkillTreeChanges::class);
    }
}
