<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model {
    protected $table = 'bank';
    protected $fillable = ['name', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
}
