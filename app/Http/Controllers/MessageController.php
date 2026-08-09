<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Display the user's conversations.
     */
    public function index(): View
    {
        $conversations = Auth::user()
            ->conversations()
            ->with('latestMessage.sender')
            ->orderByDesc('last_message_at')
            ->get();

        return view('messages.index', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * Display a conversation and its messages.
     */
    public function show(Conversation $conversation): View
    {
        // Make sure the logged-in user owns this conversation.
        if ($conversation->user_id !== Auth::id()) {
            abort(403);
        }

        // Mark messages from other users/admins as read.
        $conversation->messages()
            ->whereNull('read_at')
            ->where('sender_id', '!=', Auth::id())
            ->update([
                'read_at' => now(),
            ]);

        // Load messages with sender information.
        $conversation->load([
            'messages.sender',
        ]);

        return view('messages.show', [
            'conversation' => $conversation,
        ]);
    }

    /**
     * Create a new conversation and send the first message.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        // Create conversation.
        $conversation = Conversation::create([
            'user_id' => Auth::id(),
            'subject' => 'Support Message',
            'last_message_at' => now(),
        ]);

        // Create first message.
        Message::create([
            'conversation_id' => $conversation->conversation_id,
            'sender_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('messages.show', $conversation)
            ->with('success', 'Message sent!');
    }

    /**
     * Reply to an existing conversation.
     */
    public function reply(
        Request $request,
        Conversation $conversation
    ): RedirectResponse {
        // Make sure the logged-in user owns this conversation.
        if ($conversation->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        // Create reply.
        Message::create([
            'conversation_id' => $conversation->conversation_id,
            'sender_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        // Update conversation activity.
        $conversation->update([
            'last_message_at' => now(),
        ]);

        return back()->with('success', 'Message sent!');
    }
}
