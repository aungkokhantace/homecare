<?php

namespace App\Api\Transactionpromotion;

use Illuminate\Database\Eloquent\Model;

class Transactionpromotion extends Model
{
    protected $table = 'transaction_promotions';

    protected $fillable = [
        'id',
        'promotion_code',
        'reference_type',
        'reference_id',
        'package_id',
        'used',
        'promo_group_code',
        'promo_group_code_order',
        'remark',
        'created_at','updated_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
