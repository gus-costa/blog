<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

use App\Post;

class PagesController extends Controller {
    public function getIndex(){
        return view('pages.index')
            ->withPosts(Post::orderBy('created_at','DESC')->paginate(5));
    }

    public function getAbout(){
        return view('pages.about');
    }

    public function getContact(){
        return view('pages.contact');
    }

    public function postContact(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'email|required',
            'message' => 'required|min:10'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bodyMessage' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->replyTo($data['email']);
            $message->from(config('app.contact_to'));
            $message->to(config('app.contact_to'));
            $message->subject('New contact');
        });

        Session::flash('contact_sent', 'Your E-mail was sent!');

        return redirect()->route('contact');
    }
}