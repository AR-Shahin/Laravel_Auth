<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crud extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $guarded = [];

    function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value)
        );
    }
    public function slug(): Attribute
    {
        return new Attribute(
            set: fn ($value) => Str::slug($value)
        );
    }
}
