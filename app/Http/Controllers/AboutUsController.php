<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('information.about-us');
    }

    // Funcion para enviar email
    public function sendContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('waterlolbusiness@hotmail.com')
                ->subject('Contact Form Submission');
        });

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
