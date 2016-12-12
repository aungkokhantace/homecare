<?php

namespace App\Backend\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'product_category_id',
        'product_name',
        'price',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function productcategories()
    {
        return $this->belongsTo('App\Backend\Productcategory\Productcategory','product_category_id','id');
    }
}
