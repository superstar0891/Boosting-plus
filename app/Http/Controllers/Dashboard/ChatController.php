<?php

namespace App\Http\Controllers\Dashboard;

use App\Conversation;
use App\ConversationMessage;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Musonza\Chat\Chat;

class ChatController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Also paginate the conversations!
        if (Auth::user()->type == "Booster") {
            $conversations = Conversation::query()->where('booster_id', Auth::user()->id)->where('is_active', 1)->latest()->paginate(10);
        } elseif (Auth::user()->type == "Customer") {
            $conversations = Conversation::query()->where('customer_id', Auth::user()->id)->where('is_active', 1)->latest()->paginate(10);
        } elseif (Auth::user()->type == "Administrator") {
            $conversations = Conversation::latest()->paginate(10);
        } else {
            return abort(404);
        }

        return view('dashboard.chat.index', ['conversations' => $conversations]);
    }

    public function view(Conversation $conversation)
    {
        return view('dashboard.chat.view', [
            'conversation' => $conversation
        ]);
    }

    public function checkIfNewMessage(Request $request, Conversation $conversation)
    {
        $messageID = $request->input('message_id');
        if ($conversation->messages->last()->id != $messageID) {
            return response(200);
        }
    }

    public function startChat(Order $order)
    {
        $conversation = Conversation::startChat($order);
        return redirect(route('dashboard.chat.view', $conversation->id));
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        if ($request->input('message') != null) {
            $message = new ConversationMessage();
            $message->conversation_id = $conversation->id;
            $message->sender_id = Auth::user()->id;
            $message->message = $request->input('message');
            $message->save();
        }

        return redirect()->back();
    }

    public function announceWin(Request $request, Conversation $conversation)
    {
        if (Auth::user()->type != 'Booster') {
            return abort(404);
        }
        $message = new ConversationMessage();
        $message->conversation_id = $conversation->id;
        $message->sender_id = Auth::user()->id;
        $message->message = "The booster has announced a win! Congratulations!";
        $message->is_system_message = 1;
        $message->save();

        return redirect()->back();
    }

    public function announceLose(Request $request, Conversation $conversation)
    {
        if (Auth::user()->type != 'Booster') {
            return abort(404);
        }
        $message = new ConversationMessage();
        $message->conversation_id = $conversation->id;
        $message->sender_id = Auth::user()->id;
        $message->message = "The booster has announced a loss. Unlucky!";
        $message->is_system_message = 1;
        $message->save();

        return redirect()->back();
    }
}
