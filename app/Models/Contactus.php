<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


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
}
