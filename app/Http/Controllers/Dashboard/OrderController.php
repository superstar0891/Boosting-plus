<?php

namespace App\Http\Controllers\Dashboard;

use App\Conversation;
use App\ConversationMessage;
use App\Game;
use App\Http\Controllers\Controller;
use App\Notifications\OrderCompleted;
use App\Notifications\RequestLoginCode;
use App\Notifications\RequestLoginDetails;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.orders.index');
    }

    public function view(Order $order)
    {
        if (Auth::user()->type == "Booster" && $order->booster_id != Auth::user()->id) {
            abort(404);
        }
        if (Auth::user()->type == "Customer" && $order->customer_id != Auth::user()->id) {
            abort(404);
        }

        $conversation = Conversation::query()->where('order_id', $order->id)->first();
        return view('dashboard.orders.view', [
            'order' => $order,
            'conversation' => ($conversation != null) ? $conversation->id : null
        ]);
    }

    public function claim(Order $order)
    {
        if ($order->booster_id == null) {
            $order->booster_id = Auth::user()->id;
            $order->status = "Claimed";
            $order->save();
            Conversation::startChat($order);
            $message = new ConversationMessage();
            $message->conversation_id = $order->conversation->id;
            $message->sender_id = Auth::user()->id;
            $message->message = "Your order has been claimed and a booster will be communicating with you here very soon!";
            $message->is_system_message = 1;
            $message->save();
        }
        return redirect()->back();
    }
    public function requestLoginDetails(Order $order)
    {
        if (Auth::user()->type == "Booster" && $order->booster_id != Auth::user()->id) {
            abort(404);
        }
        $order->customer->notify(new RequestLoginDetails());
        $message = new ConversationMessage();
        $message->conversation_id = $order->conversation->id;
        $message->sender_id = Auth::user()->id;
        $message->message = "The booster has requested correct login details for this service.";
        $message->is_system_message = 1;
        $message->save();

        return redirect()->back();
    }

    public function requestLoginCode(Order $order)
    {
        if (Auth::user()->type == "Booster" && $order->booster_id != Auth::user()->id) {
            abort(404);
        }
        $order->customer->notify(new RequestLoginCode());
        $message = new ConversationMessage();
        $message->conversation_id =  $order->conversation->id;
        $message->sender_id = Auth::user()->id;
        $message->message = "The booster has requested your login code! Please place it in this chat!";
        $message->is_system_message = 1;
        $message->save();


        return redirect()->back();
    }

    public function unclaim(Order $order)
    {
        if ($order->booster_id != null && Auth::user()->type == "Administrator") {
            $order->booster_id = null;
            $order->status = "Pending";
            $order->save();
            $message = new ConversationMessage();
            $message->conversation_id = $order->conversation->id;
            $message->sender_id = Auth::user()->id;
            $message->message = "Sadly, this order has been unclaimed. It should be picked up by another booster very soon however!";
            $message->is_system_message = 1;
            $message->save();
        }
        return redirect()->back();
    }

    public function markAsStarted(Order $order)
    {
        if (Auth::user()->type == "Booster" && $order->booster_id != Auth::user()->id) {
            abort(404);
        }
        if ($order->status != 'Started' || $order->status != 'Completed') {
            $order->status = "Started";
            $order->save();
            $message = new ConversationMessage();
            $message->conversation_id = $order->conversation->id;
            $message->sender_id = Auth::user()->id;
            $message->message = "The booster has marked this order as started. They will message here with updates and information!";
            $message->is_system_message = 1;
            $message->save();
        }
        return redirect()->back();
    }
    public function markAsCompleted(Order $order)
    {
        if (Auth::user()->type == "Booster" && $order->booster_id != Auth::user()->id) {
            abort(404);
        }
        if ($order->status != 'Completed') {
            $order->status = "Completed";
            $order->save();
            $order->customer->notify(new OrderCompleted());
            $message = new ConversationMessage();
            $message->conversation_id = $order->conversation->id;
            $message->sender_id = Auth::user()->id;
            $message->message = "The booster has marked this order as completed! Thank you for using EZ-Boosting!";
            $message->is_system_message = 1;
            $message->save();
        }
        return redirect()->back();
    }

    public function delete(Order $order)
    {
        if (Auth::user()->type != "Administrator") {
            return abort(404);
        }
        $order->delete();

        return redirect(route('dashboard.orders'))->with('success', 'Order Deleted.');
    }
}
