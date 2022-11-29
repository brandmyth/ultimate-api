<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Subscriber;

class ContactController extends Controller
{
    public function addContact(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'address' => 'required|max:555',
                'phone' => 'required|min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
                'subject' => 'required',
                'message' => 'required',
                
            ];
            $customMessages = [
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Valid Email is required!',
                'email.unique' => 'Email already exists!',
                'address.required' => 'Address is required!',
                'phone.regex' => 'Valid Phone Number Required!',
                'phone.required' => 'Contact number is required!',
                'subject.required' => 'Subject is required!',
                'message.required' => 'Message is required!',
            ];
            $this->validate($request, $rules, $customMessages);

            $contact = new Contact;
            $contact->name = $data['name'];
            $contact->email = $data['email'];
            $contact->address = $data['address'];
            $contact->phone = $data['phone'];
            $contact->subject = $data['subject'];
            $contact->message = $data['message'];
            $contact->do_math = 1;

            $contact->save();

            $messages = 'Contact Form Add Successful!';
            return response()->json(['contact' => $contact, 'success_message' => $messages]);
        }
    }

    public function addSubscriber(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email' => 'required|email',                
            ];
            $customMessages = [
                'email.required' => 'Email is required!',
                'email.email' => 'Valid Email is required!',
                'email.unique' => 'Email already exists!',
            ];
            $this->validate($request, $rules, $customMessages);

            $subscriber = new Subscriber;
            $subscriber->email = $data['email'];
            $subscriber->status = 1;

            $subscriber->save();

            $messages = 'Subscriber data successfully added !!';
            return response()->json(['subscriber' => $subscriber, 'success_message' => $messages]);
        }
    }
}
