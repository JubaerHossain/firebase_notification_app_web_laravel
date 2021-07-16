<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Notifications\AlertNotification;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function saveToken(Request $request)
    {
        // auth()->user()->update(['device_token' => $request->token]);
        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification(Request $request)
    {

        $data = new Order();
        $data->title = $request->title;
        $data->body = $request->body;
        $data->user_id = 1;
        $data->save();
        $response =   Notification::send([$data->user], new AlertNotification($data));
        return $response;
    }

    public function initFirebase()
    {
        return response()->view('notifications.sw_firebase')->header('Content-Type', 'application/javascript');
    }
}
