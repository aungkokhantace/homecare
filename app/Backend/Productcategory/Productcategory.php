<?php

namespace App\Backend\Productcategory;

use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];
}
