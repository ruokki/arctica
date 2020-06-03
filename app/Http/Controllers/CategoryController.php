<?php

namespace App\Http\Controllers;

use App\Category;
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
}
