<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => Message::with('user')->orderByDesc('message_date')->paginate(25),
        ]);
    }

    public function show(Message $message): View
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', ['message' => $message->load('user')]);
    }

    public function update(Request $request, Message $message): RedirectResponse
    {
        $request->validate([
            'reply_message' => ['required', 'string', 'max:2000'],
        ]);

        $message->update([
            'reply_message' => $request->input('reply_message'),
            'reply_date'    => now(),
            'is_read'       => true,
        ]);

        return back()->with('success', 'Reply sent.');
    }
}
