<?php

namespace App\Http\Controllers;

use App\Mail\MailExample;
use Illuminate\Http\Request;
use PDF;
use Mail;

class PdfController extends Controller
{
    public function index()
    {
        $data['email'] = "arifinnur402@gmail.com";
        $data['title'] = "From Arifin";
        $data['body'] = "Test email";

        $pdf = PDF::loadview('emails.myTestMail', $data);

        $data['pdf'] = $pdf;

        Mail::to($data['email'])->send(new MailExample($data));

        dd('mail send');
    }
}
