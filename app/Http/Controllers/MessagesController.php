<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReceived;

class MessagesController extends Controller
{
    public function store(Request $request){
        //start update errors messages language
        
        //end update errors messages language

        //start validate form
        $msg = request()->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required|min:3',
        ]);
        //end validate form
        
        Mail::to('jartigas1992@gmail.com')->queue(new MessageReceived($msg));
    
        $conmsg='1';
        return view('baterias.contact', compact('conmsg'));
    }
}
