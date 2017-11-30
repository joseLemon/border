<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\ResetPassword;
use App\Providers\EventServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSending;

class MailerController extends Controller {

    function sendContactMail(Request $request) {
        $this->validate($request, [
            'contact_name'      =>  'required|max:255',
            'contact_email'     =>  'required|email',
            'contact_message'   =>  'required|max:512'
        ],[
            'contact_name.required'     =>  'The contact name is required',
            'contact_name.max'          =>  'The maximum number of characters for the contact name is :max',

            'contact_mail.required'     =>  'The email is required',
            'contact_mail.email'        =>  'The email is not valid',

            'contact_message.required'  =>  'The messages is required',
            'contact_message.max'       =>  'The maximum number of characters for the message is :max',
        ]);

        $contact_name = $request->input('contact_name');
        $contact_email = $request->input('contact_email');
        $contact_message = $request->input('contact_message');

        $contact = new \stdClass();
        $contact->contact_name = $contact_name;
        $contact->contact_email = $contact_email;
        $contact->contact_message = $contact_message;

        \Mail::to(env('CONTACT_MAIL'),env('CONTACT_NAME'))
            ->send(new Contact($contact));


        if( count(\Mail::failures()) > 0 ) {

            /*foreach(Mail::failures as $email_address) {
                echo " - $email_address <br />";
            }*/

            $jsonResponse = [
                'alert_class' => 'alert-danger',
                'msg'   => 'Failed while trying to send email, try again later'
            ];

        } else {
            $jsonResponse = [
                'alert_class' => 'alert-success',
                'msg'   => 'Message sent successfully'
            ];
        }

        return response()->json($jsonResponse);
    }
}