<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'min_ac',
        'max_ac',
        'block',
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
