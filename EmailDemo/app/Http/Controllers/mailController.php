<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;

use Illuminate\Http\Request;

class mailController extends Controller
{
    public function send(){
        Mail::to('sudhakarchinnathambi812@gmail.com')->send(new HelloMail());
    }
}
