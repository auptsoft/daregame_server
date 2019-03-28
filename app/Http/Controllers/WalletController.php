<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Wallet;
use App\WalletEvent;
use App\User;

class WalletController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->wallet();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wallet = new Wallet;
        $wallet->user_id = Auth::user()->id;

        $key = md5(microtime().rand());
        $wallet->key = $key;

        $wallet->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addAmount($amount)
    {
        $max = 500;
        if ($amount < 1) {
            throw new Exception("Amount cannot be less than 1");
        } else if($amount>500) {
            throw new Exception("Amount greater than $max. The maximum amount that can added at a time is $max.");
        } else {
            $walletEvent = new WalletEvent;
            $walletEvent->amount_added = $amount;
            $walletEvent->amount_added = 0;

            $walletEvent->key = WalletEventController::createWalletEventKey($walletEvent);
            
            $walletEvent->save();

            return true;
        }
    }

    public function removeAmount($amount)
    {
        $availableAmount = $this->computeAvailableAmount();
        $max = 500;
        if ($amount < 1) {
            throw new Exception("Amount cannot be less than 1");
        } else if($amount>$availableAmount) {
            throw new Exception("You do not have sufficient amount to perform this operation");
        } else if($amount>500) {
            throw new Exception("Amount cannot be greater than $max. The maximum amount that can added at a time is $max.");
        } else {
            $walletEvent = new WalletEvent;
            $walletEvent->amount_added = 0;
            $walletEvent->amount_added = $amount;

            $walletEvent->key = WalletEventController::createWalletEventKey($walletEvent);
            
            $walletEvent->save();

            return true;
        }
    }

    public function computeAvailableAmount() {
        $walletEvents = Auth::user()->wallet->events();
        $total = 0;
        foreach ($walletEvents as $event) {
            if (WalletEventController::verifyWalletEvent($event)){
                $total += $event->amount_added;
                $total -= $event->amount_removed;
            } else {

            }            
        }

        return $total;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Wallet::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
