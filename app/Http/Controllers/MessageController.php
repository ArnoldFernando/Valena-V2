<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('messages.index', [
            'messages' => Auth::user()->messages()->orderByDesc('message_date')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'message_of'   => Auth::id(),
            'message'      => $request->input('message'),
            'message_date' => now(),
        ]);

        return back()->with('success', 'Message sent!');
    }
}
