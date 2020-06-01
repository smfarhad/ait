<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model {
    public $timestamps = false;
    protected $table = 'module_access_permision';
    protected $fillable = [
        'user_id', 'module_id', 
        'read_access', 'write_access','edit_access', 'delete_access', 
        
    ];

}
