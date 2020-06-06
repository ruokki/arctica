<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Item extends Model
{

    protected $table = 'item';

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name', 'category_id', 'subcategory_id', 'collection_id', 'item_descript',
        'item_img', 'item_creator', 'item_release', 'item_editor', 'item_tracklist',
        'item_idx_collection', 'item_universe', 'item_type'
    ];

    protected $guarded = [ 'item_id' ];

    protected $appends = ['full_path_img', 'category_path' ];
    
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
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }

    /**
     * Sous-catégorie de l'item
     */
    public function subcategory() {
        return $this->belongsTo('App\Category', 'subcategory_id', 'category_id');
    }

    /**
     * Chemin absolu de l'image
     */
    public function getFullPathImgAttribute() {
        $tmp = new \Laravel\Lumen\Routing\UrlGenerator(app());

        return $tmp->asset('items/img/' . $this->attributes['item_img']);
    }

    /**
     * Concaténation du nom des catégories principale et secondaire
     */
    public function getCategoryPathAttribute() {
        return $this->category->category_name . ' - ' . $this->subcategory->category_name;
    }
}