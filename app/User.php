<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    /**
     * Liste des items associé aux users
     */
    public function items() {
        return $this->belongsToMany('App\Item', 'item_user', 'user_id', 'item_id');
    }

}
