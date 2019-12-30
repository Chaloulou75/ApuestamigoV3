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
    	return view('pages.contact');
    }

    public function store(Request $request)
    {
    	$mailable = new ContactMessagesCreated($request->name, $request->email, $request->msg);
    	Mail::to('admin@apuestamigo.com')->send($mailable);

    	return back()->with('message.level', 'success')->with('message.content', __('all.Your message has been sent.'));
    }
}
