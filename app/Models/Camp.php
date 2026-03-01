<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $fillable = [
        'name',
        'location',
        'capacity',
        'families_count',
        'resources_count',
        'distributions_count',
    ];
    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function distributions()
    {
        return $this->hasManyThrough(Distribution::class, Family::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
