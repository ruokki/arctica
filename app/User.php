<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class User extends Model implements Authenticatable
{

    use BasicAuthenticatable;

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    /**
     * Liste des items associé aux users
     */
    public function items() {
        return $this->belongsToMany('App\Item', 'item_user', 'user_id', 'item_id');
    }

    public function getAuthPassword() {
        return $this->user_pwd;
    }

    public function getRememberTokenName()
    {
        return '';
    }

}
