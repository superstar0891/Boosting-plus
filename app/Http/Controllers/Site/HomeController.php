<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mailchimp;
use Throwable;
use App\Game;




class HomeController extends Controller
{ 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

        {
            $games = Game::all();
            $latestGame = Game::latest()->first();
            return view('frontend.home',
                [
                    'games' => $games,
                    'latestGame' => $latestGame
                ]
            );
        }
        // return view('frontend.home');
        // return view('new_frontend.home');


    public function loyalty()
    {
        return view('frontend.loyalty');
        // return view('new_frontend.home');
    }

    public function contact_promotor(Request $request)
    {
        if($request->isMethod('post')){
            $email = $request->input('email');
            $streamer = $request->input('stream');
            $clients = $request->input('viewer');
            $ad_idea = $request->input('ideas');

            // $to = 'Ez-Boosting@hotmail.com';
            $to = 'singh.gurm87@gmail.com';

            $subject = 'Promotor Request';

        $headers = "From: " . strip_tags($email) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = 'Email: '.$email.'<br>';
        $message .= 'Stream: '.$streamer.'<br>';
        $message .= 'Potential Clients: '.$clients.'<br>';
        $message .= 'Ideas: '.$ad_idea;
        if(mail($to, $subject, $message, $headers)){
            dd("yes");
        }else{
            dd("no");
        }

        }
        return view('frontend.contact_promotor');
    }

    public function contact_booster(Request $request)
    {
        if($request->isMethod('post')){
            dd($request);
        }
        return view('frontend.contact_booster');
    }

    public function orderComplete()
    {
        return view('frontend.orderComplete');
    }

    public function tos()
    {
        $games = Game::all();
        return view('frontend.tos',
        ['games' => $games]);
    }

    public function captureEmail(Request $request)
    {
        try {
            Mailchimp::subscribe('558e2ba180', $request->input('newsletter_email'), [], false);
        } catch (Throwable $e) {
            // API call failed - user was not subscribed
            // Log the error information for debugging
           Log::error($e->getMessage());
            // Then return error message to user
        }

        Session::flash('subscribe_success');
        return redirect()->back();
    }
}
