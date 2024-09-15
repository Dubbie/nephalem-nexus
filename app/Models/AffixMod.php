<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffixMod extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'affix_id',
        'code',
        'param',
        'min',
        'max',
        'mod_number',
    ];

    protected $with = ['property'];

    public function affix()
    {
        return $this->belongsTo(Affix::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'code', 'code');
    }

    private function getDescFunction(int $fn)
    {
        $map = [
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

        return $map[$fn];
    }
}
