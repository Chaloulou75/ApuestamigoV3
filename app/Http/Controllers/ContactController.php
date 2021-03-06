<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessagesCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('pages.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|min:3',
            'email' =>'required|email',
            'msg'=>'required|min:10',
        ]);

        $mailable = new ContactMessagesCreated($request->name, $request->email, $request->msg);
        Mail::to('apuestamigo@gmail.com')->send($mailable);

        return back()->with('message.level', 'success')->with('message.content', __('all.Your message has been sent.'));
    }
}
