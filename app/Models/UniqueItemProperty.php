<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniqueItemProperty extends Model
{
    public $timestamps = false;

    protected $fillable = ['base_item_id'];

    protected $with = ['property'];

    // Link to property
    public function property()
    {
        return $this->belongsTo(Property::class, 'code');
    }
}
