<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    protected $fillable = ['item_id', 'min_damage', 'max_damage', 'min_missile_damage', 'max_missile_damage', 'min_two_handed_damage', 'max_two_handed_damage', 'required_strength', 'required_dexterity', 'speed', 'has_splash'];

    protected $appends = ['damage_type', 'damage_range'];

    public function damageType(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getDamageType(),
        );
    }

    public function damageRange(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getDamageRange(),
        );
    }

    public function splash(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hasMeleeSplash(),
        );
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    private function getDamageType(): string
    {
        if ($this->min_damage || $this->min_missile_damage) {
            return 'One-Hand Damage';
        }

        if ($this->min_two_handed_damage) {
            return 'Two-Hand Damage';
        }
    }

    private function getDamageRange(): string
    {
        if ($this->min_damage) {
            return $this->min_damage . ' to ' . $this->max_damage;
        }

        if ($this->min_missile_damage) {
            return $this->min_missile_damage . ' to ' . $this->max_missile_damage;
        }

        if ($this->min_two_handed_damage) {
            return $this->min_two_handed_damage . ' to ' . $this->max_two_handed_damage;
        }
    }
}
