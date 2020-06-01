<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {
    protected $table = 'module_register';
    protected $fillable = ['name', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
}
