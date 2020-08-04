<?php

namespace App\Api\TabletIssues;

use Illuminate\Database\Eloquent\Model;

class TabletIssues extends Model
{
    protected $table = 'log_tablet_issue';

    protected $fillable = [
        'id',
        'user_id',
        'tablet_id',
        'exception',
        'date',
        'created_at','updated_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
