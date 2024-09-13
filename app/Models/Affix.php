<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Affix extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'required_level',
        'group',
        'class',
        'group',
    ];

    protected $with = ['mods'];

    protected $appends = ['display_values'];

    public function mods()
    {
        return $this->hasMany(AffixMod::class);
    }

    // Many-to-Many relationship through AffixMod to Property
    public function properties()
    {
        return $this->hasManyThrough(
            Property::class,
            AffixMod::class,
            'affix_id', // Foreign key on AffixMod
            'code', // Foreign key on Property
            'id', // Local key on Affix (affix_id in AffixMod)
            'code' // Local key on AffixMod (code in Property)
        );
    }

    // One-to-Many relationships with other related models
    public function itemTypes()
    {
        return $this->hasMany(AffixItemType::class, 'affix_id');
    }

    public function excludedItemTypes()
    {
        return $this->hasMany(AffixExcludedItemType::class, 'affix_id');
    }

    public function displayValues(): Attribute
    {
        return new Attribute(
            get: fn() => $this->getDisplayValues(),
        );
    }

    private function getDisplayValues()
    {
        // logic here
        $displayValues = [];

        foreach ($this->mods as $mod) {
            $min = $mod->min;
            $max = $mod->max;

            if ($mod->code === 'dmg%') {
                return ['[' . $min . '-' . $max . ']% Enhanced Damage'];
            }

            foreach ($mod->property->stats as $stat) {
                // replace value with min and max values
                $final = $stat->display_value['final'];
                $newValue = '[' . $min . '-' . $max . ']';

                if ($min == $max) {
                    $newValue = $min;
                }

                if ($stat->stat === 'item_addskill_tab') {
                    $final = str_replace('[skilltab]', $this->getSkilltabName($mod->param), $final);
                }

                // handle class
                if ($this->class) {
                    $class = $this->class;
                    switch ($class) {
                        case 'ama':
                            $class = 'Amazon';
                            break;
                        case 'ass':
                            $class = 'Assassin';
                            break;
                        case 'bar':
                            $class = 'Barbarian';
                            break;
                        case 'dru':
                            $class = 'Druid';
                            break;
                        case 'nec':
                            $class = 'Necromancer';
                            break;
                        case 'pal':
                            $class = 'Paladin';
                            break;
                        case 'sor':
                            $class = 'Sorceress';
                            break;
                        default:
                            # code...
                            break;
                    }
                    $final = str_replace('[class]', $class, $final);
                }

                $final = str_replace('[value]', $newValue, $final);
                $displayValues[] = $final;
            }
        }

        return $displayValues;
    }

    private function getSkilltabName(string $param): string
    {
        $map = [
            '0' => 'Javelin and Spear',
            '1' => 'Passive and Magic',
            '2' => 'Bow and Crossbow',
            '3' => 'Fire',
            '4' => 'Lightning',
            '5' => 'Cold',
            '6' => 'Curses',
            '7' => 'Poison and Bone',
            '8' => 'Summoning',
        ];

        return $map[$param] ?? 'Unknown (' . $param . ')';
    }
}
