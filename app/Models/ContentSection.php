<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function buildSection() {
        return $this->morphOne(BuildSection::class, 'sectionable');
    }
}
