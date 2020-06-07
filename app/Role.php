<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'role_id';

    /**
     * Utilisateurs avec ce rôle
     */
    public function users() {
        return $this->hasMany('App\User', 'role_id', 'role_id');
    }
}