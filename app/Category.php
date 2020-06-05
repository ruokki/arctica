<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $primaryKey = 'category_id';

    /**
     * Récupération des sous catégories
     */
    public function subCategories() {
        return $this->hasMany('App\Category', 'category_parent_id');
    }

    // Alias
    public function children() {
        return $this->subCategories();
    }

    /**
     * Items de la catégorie (si catégorie principale)
     */
    public function itemsMain() {
        return $this->hasMany('App\Item', 'category_id', 'category_id');
    }

    /**
     * Items de la catégorie (si catégorie secondaire)
     */
    public function itemsSub() {
        return $this->hasMany('App\Item', 'subcategory_id', 'category_id');
    }

    /**
     * Récupère les items liés à la catégorie pour un user
     * 
     * SELECT subcategory_id, COUNT(subcategory_id)
     * FROM `item`
     * LEFT JOIN item_user ON item_user.item_id = item.item_id
     * WHERE user_id = 1
     * GROUP BY (subcategory_id)
     */
}
