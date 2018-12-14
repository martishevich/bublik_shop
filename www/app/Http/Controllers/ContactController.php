<?php

namespace App\Http\Controllers;

use Faker\Provider\PhoneNumber;
use Mail;
use App\Http\Requests\CreateContactRequest;
use DB;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Components\PhoneValidate;

class ContactController extends Controller
{
    public function index()
    {
        $status = false;

        return view('posts.contact', compact('status'));
    }

    public function add_contact(CreateContactRequest $request)
    {
        $validatedata = $request->validate([
            'name'    => 'required|between:3,64',
            'email'   => 'required|email',
            'phone'   => 'required|min:9|max:13',
            'subject' => 'required|max:255',
            'message' => 'required|max:4000'
        ]);
        $phone = $validatedata['phone'];
        $validatedata['phone'] = PhoneValidate::FilterPhone($phone);
        DB::table('contacts')->insert($validatedata);

        Mail::send('mail', $validatedata, function ($message) {
            $message->to('loliabombita@mail.ru', 'To web dev blog')->subject('Test mail');
            $message->from('loliabombita@mail.ru', 'Web deb blog');
        });
        if (count(Mail::failures()) > 0) {
            return view('posts.contact');
        } else {
            return view('posts.infomes')->with('name', $validatedata['name']);
        }
    }
}