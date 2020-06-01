<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCode extends Model {
    protected $table = 'payment_code';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
