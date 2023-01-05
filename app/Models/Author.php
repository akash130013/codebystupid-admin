<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Carbon;

class Author extends Model
{
    use HasFactory, Searchable;

    public $fillable = ['name', 'is_active', 'profile_image_url', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
    public function scopeNotDeleted($q)
    {
        return $q->where('is_active', '!=', DELETED);
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
