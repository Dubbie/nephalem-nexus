<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblEntry extends Model
{
    public $timestamps = false;
    public $incrementing = false;   // Disable auto-incrementing
    protected $primaryKey = 'key'; // Set 'code' as the primary key

    protected $fillable = ['key', 'value'];
}
