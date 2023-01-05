<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Carbon;


class Blog extends Model
{
    use HasFactory, Searchable;


    public $fillable = [
        'title', 'short_desc', 'long_desc', 'is_enable', 'author_id', 'status',
        'thumb_img_url', 'img_name', 'created_at', 'updated_at', 'category_id', 'duration'
    ];
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
    public function scopeActive($q)
    {
        return $q->where('status', '=', ACTIVE);
    }

    function author()
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }
    function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
