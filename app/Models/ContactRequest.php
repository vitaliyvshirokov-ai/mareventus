<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'company', 'message', 'is_processed'];
    protected function casts(): array { return ['is_processed' => 'boolean']; }
}
