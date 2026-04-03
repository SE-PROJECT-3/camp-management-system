<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Family extends Model
{
        use HasRoles;

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
