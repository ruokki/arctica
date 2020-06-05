<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'item';

    protected $primaryKey = 'item_id';
    
    /**
     * Liste des users associés à l'item
     */
    public function users() {
        return $this->belongsToMany('App\User', 'item_user', 'item_id', 'user_id');
    }

    /**
     * Catégorie de l'item
     */
    public function category() {
        return $this->belongsTo('App\Category');
    }

    /**
     * Sous-catégorie de l'item
     */
    public function subcategory() {
        return $this->belongsTo('App\Category', 'category_id', 'subcategory_id');
    }
}