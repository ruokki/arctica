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
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_descript' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'item_img' => 'required'
        ]);

        $return = [
            'error' => FALSE
        ];
        
        if($validator->fails()) {
            $return['error'] = TRUE;
            $return['errors'] = $validator->errors();
        }
        else {
            // Les champs communs sont bons, on va vérifier chaque champ sépcifique
            $cat = Category::find( $request->input('subcategory_id'));
            $subRules = [];
            foreach($cat->fields as $one) {
                $subRules[$one->field_name] = 'required';
            }
            $subValidator = Validator::make($request->all(), $subRules);

            if($subValidator->fails()) {
                $return['error'] = TRUE;
                $return['errors'] = $subValidator->errors();
            }
            else {
                $file = $request->file('item_img');
                if($file->isValid()) {
                    $newItem = new Item($request->input());

                    $file->move(storage_path('app/public'), $file->getClientOriginalName());
                    $newItem->item_img = $file->getClientOriginalName();
                    $newItem->push();
                    // @TODO Remplacer 1 par l'id du user connecté
                    $user = User::find(1);
                    $newItem->users()->sync($user);
                    $newItem->push();
                }
            }

        }

        return response()->json($return);
    }

}