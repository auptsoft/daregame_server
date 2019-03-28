<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_all', Message::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Message::class);
        $messageIn = json_decode($request->input('data'));
        if(!$messageIn) return UtilityController::GeneralResponse('failed', 'data not well formated');
        else {
            $message = new Message;
            $message->sender_id = $messageIn->sender_id;
            $message->receiver_id = $messageIn->receiver_id;
            $message->content = $messageIn->content;

            $message->save();
            return UtilityController::GeneralResponse('success', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $this->authorize('view', $message);
        return $message;
    }

    public function getReceivedMessages($user_id) {
        
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

    public function deleteForSender($id) {
        $message = Message::find($id);
        if(!$message) return UtilityController::GeneralResponse('failed', 'message not found');
        else {
            $message->sender_deleted_at = Carbon::now();
            return UtilityController::GeneralResponse('success', 'deleted successfully for the sender');
        }
    }

    public function deleteForReceiver($id) {
        $message = Message::find($id);
        if(!$message) return UtilityController::GeneralResponse('failed', 'message not found');
        else {
            $message->receiver_deleted_at = Carbon::now();
            return UtilityController::GeneralResponse('success', 'deleted successfully for the sender');
        }
    }

    public function delete(){
        $message = Message::find($id);
        if(!$message) return UtilityController::GeneralResponse('failed', 'message not found');
        else {
            $message->delete();
            return UtilityController::GeneralResponse('success', 'deleted successfully for both the sender and receiver');
        }
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
