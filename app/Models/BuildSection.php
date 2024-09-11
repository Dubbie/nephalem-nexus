<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order',
        'sectionable_id',
        'sectionable_type',
    ];

    public function sectionable()
    {
        return $this->morphTo();
    }

    public function build()
    {
        return $this->belongsTo(Build::class);
    }
}
