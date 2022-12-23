<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory, Searchable;

    public $fillable = ['title', 'comment_desc', 'image_url', 'status', 'created_at'];
    public $timestamps = false;

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }
    public function scopeNotDeleted($q)
    {
        return $q->where('status', '!=', DELETED);
    }
}
