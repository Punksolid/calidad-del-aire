<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsapp;
use Illuminate\Http\Request;

class WhatsappSubscriberController extends Controller
{
    public function inbound()
    {
        $message = \request('Body');
        
        dispatch(new SendWhatsapp($message));

    }
}
