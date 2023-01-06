<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Carbon;

class Contactus extends Model
{
    use HasFactory, Searchable;

    public $fillable = ['name', 'email', 'comment', 'status', 'created_at', 'updated_at', 'subject'];
    public $timestamps = false;

    public function toSearchableArray()
    {
        return [
            'name' => $this->title,
        ];
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
