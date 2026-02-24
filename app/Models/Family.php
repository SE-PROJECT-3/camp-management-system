<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'name',
        'members_count',
        'category',
        'priority',
        'camp_id',
    ];

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
