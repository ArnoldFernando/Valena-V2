<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $conversations = Conversation::with([
            'user',
            'latestMessage.sender',
        ])
            ->orderByDesc('last_message_at')
            ->paginate(25);

        return view('admin.messages.index', [
            'conversations' => $conversations,
        ]);
    }

    public function show(Conversation $conversation): View
    {
        // Explicitly load the conversation owner and messages.
        $conversation->load([
            'user',
            'messages.sender',
        ]);

        // Make sure the conversation actually has a user.
        if (!$conversation->user) {
            abort(
                500,
                "Conversation {$conversation->conversation_id} has no valid user."
            );
        }

        // Mark messages from users as read.
        // Don't mark admin's own messages as read.
        $conversation->messages()
            ->whereNull('read_at')
            ->where('sender_id', '!=', auth()->id())
            ->update([
                'read_at' => now(),
            ]);

        // Refresh the conversation after updating messages.
        $conversation->load([
            'user',
            'messages.sender',
        ]);

        return view('admin.messages.show', [
            'conversation' => $conversation,
        ]);
    }

    public function reply(
        Request $request,
        Conversation $conversation
    ): RedirectResponse {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'conversation_id' => $conversation->conversation_id,
            'sender_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        $conversation->update([
            'last_message_at' => now(),
        ]);

        return back()->with('success', 'Reply sent!');
    }

    public function update(
        Request $request,
        Conversation $conversation
    ): RedirectResponse {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $message = $conversation->messages()
            ->where('sender_id', auth()->id())
            ->latest('created_at')
            ->firstOrFail();

        $message->update([
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Message updated!');
    }

    public function destroy(
        Conversation $conversation
    ): RedirectResponse {
        $conversation->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Conversation deleted!');
    }
}
