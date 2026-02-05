<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'name.required'    => 'Please enter your name.',
            'email.required'   => 'Please enter your email address.',
            'email.email'      => 'Please enter a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please enter your message.',
        ]);

        $toEmail = Setting::get('contact_email', 'info@estgroup.com.my');

        try {
            Mail::to($toEmail)->send(new ContactFormMail(
                senderName: $validated['name'],
                senderEmail: $validated['email'],
                formSubject: $validated['subject'],
                messageBody: $validated['message'],
            ));
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Sorry, we could not send your message. Please try again later or email us directly.');
        }

        return redirect()->route('contact')->with('success', 'Thank you! Your message has been sent. We will get back to you soon.');
    }
}
