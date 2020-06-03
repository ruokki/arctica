<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Table du model
     */
    protected $table = 'category';

    protected $primaryKey = 'category_id';

    /**
     * Récupération des sous catégories
     */
    public function subCategories() {
        return $this->hasMany('App\Category', 'category_parent_id');
    }

    public function children() {
        return $this->subCategories();
    }
}
