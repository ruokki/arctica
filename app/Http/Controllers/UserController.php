<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Création d'un utilisateur
     */
    public function createUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:100|unique:App\User',
            'user_firstname' => 'required|max:100',
            'user_lastname' => 'required|max:100',
            'user_email' => 'required|max:100|email|unique:App\User',
            'user_pwd' => 'required|max:100',
        ]);
        $return = [ 'error' => FALSE ];

        if($validator->fails()) {
            $return['error'] = TRUE;
            $return['errors'] = $validator->errors();
        }
        else {
            $user = new User($request->input());
            $user->user_active = 1;
            $role = Role::where('role_name', 'utilisateur')->get()->first();
            $user->role()->associate($role);
            $user->push();
        }

        return response()->json($return);
    }
}