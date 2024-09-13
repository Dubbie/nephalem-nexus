<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $timestamps = false;
    public $incrementing = false;   // Disable auto-incrementing
    protected $primaryKey = 'stat'; // Set 'code' as the primary key

    private const DESCRIPTIONS = [
        1 => "+[value] [string1]",
        2 => "[value]% [string1]",
        3 => "[value] [string1]",
        4 => "+[value]% [string1]",
        5 => "[value*100/128]% [string1]",
        6 => "+[value] [string1] [string2]",
        7 => "[value]% [string1] [string2]",
        8 => "+[value]% [string1] [string2]",
        9 => "[value] [string1] [string2]",
        10 => "[value*100/128]% [string1] [string2]",
        11 => "Repairs 1 Durability In [100 / value] Seconds",
        12 => "+[value] [string1]",
        13 => "+[value] to [class] Skill Levels",
        14 => "+[value] to [skilltab] Skill Levels ([class] Only)",
        15 => "[chance]% to case [slvl] [skill] on [event]",
        16 => "Level [sLvl] [skill] Aura When Equipped ",
        17 => "[value] [string1] (Increases near [time])",
        18 => "[value]% [string1] (Increases near [time])",
        19 => "this is used by stats that use Blizzard's sprintf implementation (if you don't know what that is, it won't be of interest to you eitherway I guess), look at how prismatic is setup, the string is the format that gets passed to their sprintf spinoff.",
        20 => "[value * -1]% [string1]",
        21 => "[value * -1] [string1]",
        22 => "[value]% [string1] [montype] (warning: this is bugged in vanilla and doesn't work properly, see CE forum)",
        23 => "[value]% [string1] [monster]",
        24 => "used for charges, we all know how that desc looks ",
        25 => "not used by vanilla, present in the code but I didn't test it yet",
        26 => "not used by vanilla, present in the code but I didn't test it yet",
        27 => "+[value] to [skill] ([class] Only)",
        28 => "+[value] to [skill]",
    ];

    protected $fillable = [
        'stat',
        'desc_func',
        'desc_priority',
        'desc_value',
        'desc_str_pos',
        'desc_str_neg',
        'desc_str_2',
        'desc_group',
        'desc_group_value',
        'desc_group_str_pos',
        'desc_group_str_neg',
        'desc_group_str_2',
    ];

    protected $with = ['strPos', 'strNeg', 'str2'];

    protected $appends = ['display_value'];

    public function displayValue(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getDisplayValue()
        );
    }

    public function strPos()
    {
        return $this->belongsTo(TblEntry::class, 'desc_str_pos', 'key');
    }

    public function strNeg()
    {
        return $this->belongsTo(TblEntry::class, 'desc_str_neg', 'key');
    }

    public function str2()
    {
        return $this->belongsTo(TblEntry::class, 'desc_str_2', 'key');
    }

    private function getDisplayValue(): array
    {
        $string1 = $this->strPos->value ?? null;
        $string2 = $this->str2->value ?? null;

        // Function
        $final = self::DESCRIPTIONS[$this->desc_func] ?? null;

        // $final = str_replace('[value]', $this->desc_value, $final);
        $final = str_replace('[string1]', $string1, $final);
        $final = str_replace('[string2]', $string2, $final);

        return [
            'strPos' => $this->strPos->value ?? null,
            'strNeg' => $this->strNeg->value ?? null,
            'str2' => $this->str2->value ?? null,
            'final' => $final,
        ];
    }
}
