<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FleetImage extends Model
{
    protected $fillable = ['path', 'caption', 'sort_order'];
}
