<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendTestEmail()
    {
        Mail::to('jovenandrei0324@gmail.com')->send(new TestEmail());

        return 'Test email sent successfully!';
    }
}
