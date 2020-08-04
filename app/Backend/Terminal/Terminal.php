<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/14/2016
 * Time: 6:11 PM
 */

namespace App\Backend\Terminal;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    public $incrementing = false;
    protected $table = 'terminals';

    protected $fillable = [
        'id',
        'tablet_id',
        'remark','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
