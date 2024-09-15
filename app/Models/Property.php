<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $timestamps = false;
    public $incrementing = false;   // Disable auto-incrementing
    protected $primaryKey = 'code'; // Set 'code' as the primary key

    protected $fillable = [
        'code',
        'done',
        'desc',
        'param',
        'min',
        'max',
    ];

    protected $with = ['stats'];

    public function propertyStats()
    {
        return $this->hasMany(PropertyStat::class, 'code', 'code');
    }

    public function stats()
    {
        return $this->hasManyThrough(
            Stat::class,           // Final target model
            PropertyStat::class,   // Intermediate model
            'code',                // Foreign key on PropertyStat (from Property)
            'stat',                // Foreign key on Stat (from PropertyStat)
            'code',                // Local key on Property (matches PropertyStat)
            'stat'                 // Local key on PropertyStat (matches Stat)
        );
    }
}
