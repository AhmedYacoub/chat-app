<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class ContactsController extends Controller
{
    /**
     * Get all users as contact except current user
     *
     * @return json object
     */
    public function get()
    {
        // get all users profiles except user's
        $contacts = User::where('id', '!=', auth()->id())->get();

        return response()->json($contacts);
    }

    /**
     * Get all messages between current authenticated user and a contact
     *
     * @param int $id
     * @return json object
     */
    public function getContactMessages($id)
    {
        $messages = Message::getMessages($id)->get();
        
        return response()->json($messages);
    }

    public function send()
    {
        // validate incoming request
        request()->validate([
            'contact_id'    =>  'required|numeric',
            'text'          =>  'required'
        ]);

        // create a new message
        $message = Message::create([
            'from'  =>  auth()->id(),
            'to'    =>  request()->contact_id,
            'text'  =>  request()->text
        ]);

        broadcast(new NewMessage($message));
        
        // respond with a json response
        return response()->json($message);
    }
}
