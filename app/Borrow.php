<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{

    protected $table = 'borrow';

    protected $primaryKey = 'borrow_id';

    /**
     * Emprunteur
     */
    public function lender() {
        return $this->belongsTo('App\User', 'lender_id', 'user_id');
    }

    /**
     * Prêteur
     */
    public function borrower() {
        return $this->belongsTo('App\User', 'borrower_id', 'user_id');
    }

    /**
     * Item
     */
    public function item() {
        return $this->belongsTo('App\Item', 'item_id');
    }

}
