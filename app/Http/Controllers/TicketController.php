<?php

namespace App\Http\Controllers;

use App\Mail\TicketNotificationSend;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->orderBy('status', 'desc')->paginate(10);
        return view('backend.ticket', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'status' => 'open',
            'ticket_no'=>'T_'. mt_rand(10000, 99999),
        ]);
        $mailId = User::where('role','admin')->first()->email;
        Mail::to($mailId)->send(new TicketNotificationSend('New Ticket Create',$ticket,'New Ticket Opened'));

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    }

    public function close($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = 'close';
        $ticket->update();
        $mailId = User::find($ticket->user_id)->email;
        Mail::to($mailId)
            ->send(new TicketNotificationSend('Your Ticket Closed',$ticket,'Ticket Closed'));
        return redirect()->route('tickets.index')->with('success', 'Ticket closed successfully!');
    }

}
