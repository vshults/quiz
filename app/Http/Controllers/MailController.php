<?php

namespace App\Http\Controllers;

use App\Mail\quizMail;
use App\Models\Eloquent\Hosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\PageTickets;

class MailController extends Controller
{
    public function __construct()
    {
        $this->pageTickets  = new PageTickets();
    }

    public function sendTicket($ticketID, $hostID)
    {
        $emails = Hosts::where('id', (int)$hostID)->pluck('control_emails')->toArray();

        $data   = $this->pageTickets->showTicket($ticketID);

        if (!empty($emails[0])) {

            $emails = explode(PHP_EOL, $emails[0]);

            foreach ($emails as $email){
                Mail::to($email)->send(new quizMail($data));
            }

        }
    }
}
