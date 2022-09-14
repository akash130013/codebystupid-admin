<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Blog extends Model
{
    use HasFactory, Searchable;


    public $fillable = ['title', 'short_desc', 'long_desc', 'is_enable'];
    public $timestamps = false;

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }
}
