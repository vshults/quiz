<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PageTickets;
use App\Models\Admin\PageHost;
use App\Models\Eloquent\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->pageTickets  = new PageTickets();
        $this->pageHosts    = new PageHost();
    }

    public function index(Request $request)
    {
        $request = $request->all();

        $user_id             = (int)Auth::user()->id;
        $sort                = !empty(request()) ? request() : 'all' ;
        $count               = $this->pageTickets->countTickets();
        $page                = !empty(request()->page) ? request()->page : 1;
        $offset              = 2;
        $offsetTwo           = $offset * $page;

        $data['tickets']     = $this->pageTickets->show($user_id,$sort);
        $data['hosts']       = $this->pageHosts->showForUser($user_id);
        $data['count']       = $count;
        $data['counts']      = $this->pageTickets->countTicketsHost($user_id);
        $data['offset']      = $count < $offsetTwo ? $count : $offsetTwo;

        return view('admin.ticket.tickets', $data);
    }


    public function showTicket(Request $request){
        $id   = (int)$request->route('id');
        $data = $this->pageTickets->showTicket($id);

        return view('admin.ticket.ticketShow', $data);

    }

}
