<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Order;
use App\Client;
use App\OrderProduct;
class OrdersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $orders = '';
        if (Auth::user()->client) {
            $userClientId = Auth::user()->client->client_id;
            $orders = Order::orderBy('created_at', 'desc')->where('client_id_fk', $userClientId)->get();
        }
        return view('orders.index')->with('orders', $orders);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $cart = Session::get('cart');
        $orders = $cart->items;
        $client = '';
        if (Auth::user()->client) {
            $client = Auth::user()->client;
        }
        return view('orders.create')->with(['orders' => $orders, 'cart' => $cart, 'client' => $client]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'PaymentRadio' => 'required'
        ]);
        $cart = Session::get('cart');
        $products = $cart->items;
        $client = Auth::user()->client;
        // Create oreder
        $order = new Order;
        $order->client_id_fk = $client->client_id;
        $order->order_price = $cart->totalPrice;
        $order->order_status = 'not paid';
        $order->save();
        // Handle products
        foreach($products as $product){
            $orderLine = new OrderProduct;
            $orderLine->order_id_fk = $order->order_id;
            $orderLine->product_id_fk = $product['item']['product_id'];
            $orderLine->quantity = $product['qty'];
            $orderLine->price = $product['price'];
            $orderLine->save();
        }
        // Store payment methode in session
        Session::put('paymentMethod', $request->input('PaymentRadio'));
        // Clear cart from session
        Session::forget('cart');
        return redirect('/orders/'.$order->order_id.'/edit');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = Order::find($id);
        $products = $order->products;
        return view('orders.show')->with(['order' => $order, 'products' => $products]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $order = Order::find($id);
        return view('orders.edit')->with(['order' => $order]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Update oreder status
        $order = Order::find($id);
        $order->order_status = 'paid';
        $order->save();
        // Remove paymentMethod from session
        Session::forget('paymentMethod');
        return redirect('/orders/'.$order->order_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}