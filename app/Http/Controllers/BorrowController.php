<?php

namespace App\Http\Controllers;

use App\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Récupération des demandes de prêts en attente
     */
    public function getMyWaitingLend() {
        // @TODO Mettre l'id du user connecté dans le where
        $waitingLend = Borrow::where('borrower_id', 1)
                    ->with(['item', 'lender'])
                    ->limit(10)
                    ->get();
        $return = [];
        
        foreach($waitingLend as $one) {
            array_push($return, [
                'borrow_id' => $one->borrow_id,
                'borrow_duration' => $one->borrow_duration,
                'user_name' => $one->lender->user_name,
                'item_name' => $one->item->item_name,
            ]);
        }

        return response()->json($return);
    }

    /**
     * Récupération les emprunts en cours
     */
    public function getMyRunningBorrow() {
        // @TODO Mettre l'id du user connecté dans le where
        $runningBorrow = Borrow::where('lender_id', 1)
                    ->with(['item', 'borrower'])
                    ->limit(10)
                    ->get();
        $return = [];

        foreach($runningBorrow as $one) {
            array_push($return, [
                'borrow_id' => $one->borrow_id,
                'borrow_date_end' => $one->borrow_date_end,
                'user_name' => $one->borrower->user_name,
                'item_name' => $one->item->item_name,
            ]);
        }

        return response()->json($return);
    }

    /**
     * Récupération des emprunts du user
     */
    public function getMyBorrow() {
        $borrows = Borrow::where('lender_id', 1)
                    ->with(['item', 'borrower'])
                    ->orderBy('borrow_state', 'ASC')
                    ->get();
        
        return response()->json($borrows);
    }

    /**
     * Récupération des prêts du user
     */
    public function getMyLend() {
        $borrows = Borrow::where('borrower_id', 1)
                    ->with(['item', 'borrower'])
                    ->whereNotIn('borrow_state', ['DE', 'GB'])
                    ->orderBy('borrow_state', 'ASC')
                    ->get();
        
        return response()->json($borrows);
    }
}