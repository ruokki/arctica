<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Field;
use App\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    /**
     * Récupération de l'ensemble des catégories
     */
    public function getAll() {
        $mainCat = Category::where('category_parent_id', 0)
                    ->with(['children', 'children.fields'])
                    ->get();

        return response()->json($mainCat);
    }

    /**
     * Récupération du nombre d'item par sous-catégorie
     */
    public function getRepartForUser() {
        $subCats = Category::where('category_parent_id', '!=', 0)
                        ->get();
        $repart = [];

        // Récupération des items pour chaque sous catégorie
        foreach($subCats as $one) {
            // Récupération des users pour chaque item
            foreach($one->itemsSub as $item) {
                // @TODO Mettre l'id du user connecté dans le where
                $repart[$one->category_id] = $item->users->where('user_id', 1)->count();
            }
        }

        return response()->json($repart);
    }

    /**
     * Récupération des items associés à une catégorie
     */
    public function getItems($id) {
        if($id === 'mine') {
            // @TODO Mettre l'id du user connecté
            $items = Item::has('users', 1)
                    ->with(['category', 'subcategory'])
                    ->get();
        }
        else {
            $items = Item::where('subcategory_id', $id)
                    ->with(['category', 'subcategory'])
                    ->get();
        }
        
        return response()->json($items);
    }

}
