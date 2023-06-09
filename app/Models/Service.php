<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function serials()
    {
        return $this->hasMany(Serial::class);
    }

    public function apiProvider()
    {
        return $this->belongsTo(ApiProvider::class);
    }
}
