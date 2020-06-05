<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    /**
     * Récupération de l'ensemble des catégories
     */
    public function getAll() {
        $mainCat = Category::where('category_parent_id', 0)
                    ->get();

        foreach($mainCat as $one) {
            $one->children;
        }

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
                $repart[$one->category_id] = $item->users->where('user_id', 1)->count();
            }
        }

        return response()->json($repart);
    }

}
