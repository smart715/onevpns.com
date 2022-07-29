<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserListModel extends Model
{
    protected $table  = 'user_list';

    public function parent()
    {
        return $this->belongsTo('App\ServerListModel', 'ust_server_id');
    }

    public function children()
    {
        return $this->hasMany('App\ServerListModel', 'ust_server_id');
    }
}
