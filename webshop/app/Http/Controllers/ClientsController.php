<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Client;
class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    // Create the client information and connect to user
    public function create() {
        if (Auth::user()->client) {
            return redirect('/dashboard');
        }
        return view('clients.create');
    }
    // Store the client
    public function store(Request $request) {
        $this->validate($request, [
            'date-of-birth' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|max:13|min:10',
            'postal-code' => 'required|max:10|min:3',
            'house-number' => 'required|numeric',
            'house-number-addition' => 'nullable',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);
        // Get user
        $user = Auth::user();
        // Create client
        $client = new Client;
        $client->user_id = $user->id;
        
        $client->date_of_birth = $request->input('date-of-birth');
        $client->gender = $request->input('gender');
        $client->phone_number = $request->input('phone');
        // Billing address
        $client->billing_postal_code = $request->input('postal-code');
        $client->billing_house_number = $request->input('house-number');
        $client->billing_house_number_addition = $request->input('house-number-addition');
        $client->billing_street = $request->input('street');
        $client->billing_city = $request->input('city');
        $client->billing_country = $request->input('country');
        // Shippig address
        $client->shipping_postal_code = $request->input('postal-code');
        $client->shipping_house_number = $request->input('house-number');
        if ($request->input('house-number-addition')) {
            $client->shipping_house_number_addition = $request->input('house-number-addition');
        }
        $client->shipping_street = $request->input('street');
        $client->shipping_city = $request->input('city');
        $client->shipping_country = $request->input('country');
        $client->save();
        return redirect()->back();
    }
    // Edit client information
    public function edit() {
        $client  = Auth::user()->client;
        return view('clients.edit')->with('client', $client);
    }
    // update client information
    public function update(Request $request, $id) {
        $this->validate($request, [
            'date-of-birth' => 'required|date',
            'gender' => 'required',
            'phone-number' => 'required|max:13|min:10'
        ]);
        $client = Client::find($id);
        $client->date_of_birth = $request->input('date-of-birth');
        $client->gender = $request->input('gender');
        $client->phone_number = $request->input('phone-number');
        $client->save();
        return redirect('/dashboard')->with('success', 'Saved');
    }
    // Edit billing address information
    public function editBillingAddress() {
        $client  = Auth::user()->client;
        return view('clients.edit-billing-address')->with('client', $client);
    }
    // update billing address information
    public function updateBillingAddress(Request $request, $id) {
        $this->validate($request, [
            'postal-code' => 'required|max:10|min:3',
            'house-number' => 'required|numeric',
            'house-number-addition' => 'nullable',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);
        $client = Client::find($id);
        $client->billing_postal_code = $request->input('postal-code');
        $client->billing_house_number = $request->input('house-number');
        if ($request->input('house-number-addition')) {
            $client->billing_house_number_addition = $request->input('house-number-addition');
        }
        $client->billing_street = $request->input('street');
        $client->billing_city = $request->input('city');
        $client->billing_country = $request->input('country');
        $client->save();
        return redirect('/dashboard')->with('success', 'Saved');
    }
    // Edit shipping address information
    public function editShippingAddress() {
        $client  = Auth::user()->client;
        return view('clients.edit-shipping-address')->with('client', $client);
    }
    // update shipping address information
    public function updateShippingAddress(Request $request, $id) {
        $this->validate($request, [
            'postal-code' => 'required|max:10|min:3',
            'house-number' => 'required|numeric',
            'house-number-addition' => 'nullable',
            'street' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);
        $client = Client::find($id);
        $client->shipping_postal_code = $request->input('postal-code');
        $client->shipping_house_number = $request->input('house-number');
        if ($request->input('house-number-addition')) {
            $client->shipping_house_number_addition = $request->input('house-number-addition');
        }
        $client->shipping_street = $request->input('street');
        $client->shipping_city = $request->input('city');
        $client->shipping_country = $request->input('country');
        $client->save();
        return redirect('/dashboard')->with('success', 'Saved');
    }
}