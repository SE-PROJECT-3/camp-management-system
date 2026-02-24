<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'name',
        'type',
        'quantity',
        'camp_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }
}
