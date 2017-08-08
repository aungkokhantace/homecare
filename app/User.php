<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="core_users";
    public $incrementing = false;
    protected $fillable = [
        'id','name','phone','email','fees','display_image','mobile_image','password','role_id','address','active','updated_at','created_at','deleted_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getObjByID(){
        return $this->id;
    }
    public function role()
    {
        return $this->belongsTo('App\Core\Role\Role','role_id','id');
    }
    public function session(){
        return $this->hasMany('App\Session\Session');
    }

    public function addendum()
    {
        return $this->hasMany('App\Backend\Addendum\Addendum');
    }

    public function patient()
    {
        return $this->hasOne('App\Backend\Patient\Patient');
    }
}
