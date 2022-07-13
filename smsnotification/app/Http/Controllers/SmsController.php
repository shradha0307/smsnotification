<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Twilio\Rest\Client;

use Illuminate\Routing\Redirector;

use PhpParser\Node\Expr\Throw_;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class SmsController extends Controller
{
    //
    public function sendSMS(Request $request)
    {
        try {

            $account_sid = env('TWILIO_SID');
            $account_token = env('TWILIO_TOKEN');
            $number = env('TWILIO_FROM');

            $client = new Client($account_sid, $account_token);
            $client->messages->create('+91' . $request->number, [
                'from' => $number,
                'body' => $request->message
            ]);

            return back()->with('message', 'Message Sent Successfully!');
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }
}
