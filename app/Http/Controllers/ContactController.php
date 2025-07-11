<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

     public function landingpage()
    {
        return view('landingpage.homepage');
    }

    public function aboutus()
    {
        return view('landingpage.aboutus');
    }

 public function achivement()
    {
        return view('landingpage.achivment');
    }
    // Show Contact Us page
    public function show()
    {
        return view('landingpage.contact-us');
    }

    // Handle Contact Form Submission
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'Send_from' => 'user',
            'message' => $request->message,
        ]);

        return redirect()->route('contact.show')->with('success', 'Your message has been sent successfully.');
    }

   public function index()
{
    $contacts = Contact::where('Send_from', 'user')->latest()->get();

    return view('contact.contact_index', compact('contacts'));
}


    public function reply($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.reply', compact('contact'));
    }

    public function sendReply(Request $request, $id)
{
    $request->validate([
        'reply_message' => 'required|string',
    ]);

    $originalContact = Contact::findOrFail($id);


    $emailContent = "Your Query :\n\n"
                  . $originalContact->message . "\n\n"
                  . "Reply :\n\n"
                  . $request->reply_message;


    Mail::raw($emailContent, function ($message) use ($originalContact) {
        $message->to($originalContact->email)
                ->subject('Reply from GVJC College');
    });


    Contact::create([
        'name' => 'Admin',
        'email' => $originalContact->email,
        'Send_from' => 'admin',
        'message' => $request->reply_message,
    ]);

    return redirect()->route('contact.index')->with('success', 'Reply sent and saved successfully.');
}



public function getConversation($id)
{
    $contact = Contact::findOrFail($id);
    $conversation = Contact::where('email', $contact->email)->orderBy('created_at')->get();
    return response()->json($conversation);
}



}
