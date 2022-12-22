<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Blog extends Model
{
    use HasFactory, Searchable;


    public $fillable = [
        'title', 'short_desc', 'long_desc', 'is_enable', 'author_id', 'status',
        'thumb_img_url', 'img_name', 'created_at', 'updated_at', 'category_id'
    ];
    public $timestamps = false;

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }

    function author()
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }
}
