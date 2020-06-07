<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Model implements Authenticatable
{

    use BasicAuthenticatable;

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name', 'user_firstname', 'user_lastname', 'user_email', 'user_pwd'
    ];

    /**
     * Liste des items associé aux users
     */
    public function items() {
        return $this->belongsToMany('App\Item', 'item_user', 'user_id', 'item_id');
    }

    /**
     * Role du User
     */
    public function role() {
        return $this->belongsTo('App\Role', 'role_id', 'role_id');
    }

    /**
     * Enregistrement du mot de passe
     */
    public function setUserPwdAttribute($pass) {
        $this->attributes['user_pwd'] = Hash::make($pass);
    }

    public function getAuthPassword() {
        return $this->user_pwd;
    }

    public function getRememberTokenName()
    {
        return '';
    }

}
