<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Head extends Model {
    protected $table = 'head';
    protected $fillable = ['name', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
}
