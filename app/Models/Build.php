<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Build extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'diablo_class_id',
        'active',
        'introduction'
    ];

    protected $with = ['author', 'diabloClass', 'skillTrees'];

    protected $appends = [
        'is_complete',
        'view_count',
        'like_count',
        'liked'
    ];

    public function isComplete(): Attribute
    {
        return new Attribute(get: fn() => $this->checkIfComplete());
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function diabloClass()
    {
        return $this->belongsTo(DiabloClass::class);
    }

    public function skillTrees()
    {
        return $this->hasMany(SkillTree::class);
    }

    public function sections()
    {
        return $this->hasMany(BuildSection::class)->orderBy('order');
    }

    public function views()
    {
        return $this->hasMany(BuildView::class);
    }

    public function likes()
    {
        return $this->hasMany(BuildLike::class);
    }

    public function viewCount(): Attribute
    {
        return new Attribute(get: fn() => $this->views->count());
    }

    public function likeCount(): Attribute
    {
        return new Attribute(get: fn() => $this->likes->count());
    }

    public function liked(): Attribute
    {
        return new Attribute(get: fn() => $this->likes()->where('user_id', Auth::id())->exists());
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    private function checkIfComplete()
    {
        // Check introduction is not empty.
        if (! $this->introduction) {
            return false;
        }

        // Check skill tree exists.
        if (! $this->skillTrees->count()) {
            return false;
        }

        return true;
    }
}
