<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildView extends Model
{
    protected $fillable = [
        'build_id',
        'ip_address',
    ];
}
