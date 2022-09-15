<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Author extends Model
{
    use HasFactory, Searchable;

    public $fillable = ['name', 'is_active', 'profile_image_url'];
    public $timestamps = false;

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
}
