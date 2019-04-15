<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Client;
use App\Order;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $client = Client::where('user_id', Auth::user()->id)->first();
        $order = '';
        if ($client) {
            $order = Order::where('client_id_fk', $client->client_id)->orderBy('created_at', 'desc')->first();
        }
        
        return view('dashboard')->with(['client' => $client, 'order' => $order]);
    }
}