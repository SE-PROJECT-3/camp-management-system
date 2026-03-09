<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'family_id',
        'resource_id',
        'quantity',
        'received',
        'distributed_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'received' => 'boolean',
        'distributed_at' => 'datetime',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
    
}
