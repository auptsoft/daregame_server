<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Wallet;
use App\WalletEvent;

class WalletEventController extends Controller
{  
    public function createWalletEventKey($walletEvent) {
        $key = Hash::make($walletEvent->amount_added.$walletEvent->amount_removed.$walletEvent->created_at."we123");
        return $key;
    }

    public function verifyWalletEvent($walletEvent) {
        $key = Hash::make($walletEvent->amount_added.$walletEvent->amount_removed.$walletEvent->created_at."we123");
        if ($walletEvent->key == $key) {
            return true;
        } else {
            return false;
        }
    }
}