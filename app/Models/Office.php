<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model {
    public $timestamps = false;
    protected $table = 'office';
    protected $fillable = [
        'id','name', 'order_by'
    ];

}
