<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Enregistre un nouvel item ou les modifications sur un item existant
     */
    public function setItem(Request $request) {
        // On va vérifier l'ensemble des champs communs à chaque objet
        $rules = [
            'item_name' => 'required',
            'item_descript' => 'required',
            'item_img' => 'required'
        ];

        $return = [
            'error' => FALSE
        ];

        // On va aussi vérifier chaque champ spécifique
        $cat = Category::find( $request->input('subcategory_id'));
        foreach($cat->fields as $one) {
            $rules[$one->field_name] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()) {
            $return['error'] = TRUE;
            $return['errors'] = $validator->errors();
        }
        else {
            $file = $request->file('item_img');
            if($file->isValid()) {
                $newItem = new Item($request->input());
                
                $file->move(public_path('items/img'), $file->getClientOriginalName());
                $newItem->item_img = $file->getClientOriginalName();
                $newItem->push();
                // @TODO Remplacer 1 par l'id du user connecté
                $user = User::find(1);
                $newItem->users()->sync($user);
                $newItem->push();
            }
        }

        return response()->json($return);
    }

}