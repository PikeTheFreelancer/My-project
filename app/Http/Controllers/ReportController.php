<?php

namespace App\Http\Controllers;

use App\Mail\UserReport;
use App\Models\ReportReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function sendMail(Request $request)
    {
        Mail::to(config('app.mailto'))->send(new UserReport($request));

        return redirect()->back()->with('message', 'Email has been sent successfully!');
    }
}
