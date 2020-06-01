<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'name', 'username','remember_token', 'user_type','email', 'password', 'office_id', 'is_activated'
         
    ];

}
