<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ait extends Model {
    public $timestamps = false;
    protected $table = 'ait';
    protected $fillable = [
        'head_id','deduction_authority', 'name_of_beneficiary', 'tin','amount','chalan_no', 'payment_code','chalan_date', 'comments',
        'created_by', 'office_id', 'bank_id','branch_id', 'deleted_by', 'status'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

}
