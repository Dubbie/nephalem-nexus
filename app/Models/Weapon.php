<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'min_damage',
        'max_damage',
        'min_two_handed_damage',
        'max_two_handed_damage',
        'min_missile_damage',
        'max_missile_damage',
        'speed',
        'required_strength',
        'required_dexterity',
        'has_splash',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // Delete associated item if it exists
            $item = $model->item;
            if ($item) {
                $item->delete();
            }
        });
    }

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }
}
