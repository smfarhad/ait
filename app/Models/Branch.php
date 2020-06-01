<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
    protected $table = 'branch';
    protected $fillable = ['name', 'bank_id','status'];
    protected $hidden = ['created_at', 'updated_at'];
}
