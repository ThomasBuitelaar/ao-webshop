@extends('layouts.app')

@section('content')
    @if(Auth::user()->client)
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <div class="card card-default">
                <div class="card-header"><h5 class="pull-left mt-2">User information</h5>
                    <a href="/users/{{Auth::user()->id}}" role="button" class="btn btn-outline-success pull-right">Edit</a></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Name: {{Auth::user()->name}}</li>
                        <li class="list-group-item">Surname: {{Auth::user()->surname}}</li>
                        <li class="list-group-item">Email: {{Auth::user()->email}}</li>
                    </ul>
                </div>
            </div>
        </div>
         <div class="col-12 col-md-6 mb-3">
            <div class="card card-default">
                <div class="card-header">
                    <h5 class="pull-left mt-2">Additional information</h5>
                    <a href="clients/edit" role="button" class="btn btn-outline-success pull-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Date of Birth: <span> {{date_format(new DateTime($client->date_of_birth), 'd-m-Y')}}</span></li>
                        <li class="list-group-item">Gender: {{$client->gender}}</li>
                        <li class="list-group-item">Phone Number: {{$client->phone_number}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="card card-default">
                <div class="card-header">
                    <h5 class="pull-left mt-2">Billing Address Details</h5>
                    <a href="clients/edit-billing-address" role="button" class="btn btn-outline-success pull-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Postal Code: {{$client->billing_postal_code}}</li>
                        <li class="list-group-item">House Number: {{$client->billing_house_number}}</li>
                        @if($client->billing_house_number_addition)
                            <li class="list-group-item">House Number Addition: {{$client->billing_house_number_addition}}</li>
                        @endif
                        <li class="list-group-item">Street: {{$client->billing_street}}</li>
                        <li class="list-group-item">City: {{$client->billing_city}}</li>
                        <li class="list-group-item">Country: {{$client->billing_country}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="card card-default">
                <div class="card-header">
                    <h5 class="pull-left mt-2">Shipping Address Details</h5>
                    <a href="clients/edit-shipping-address" role="button" class="btn btn-outline-success pull-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Postal Code: {{$client->shipping_postal_code}}</li>
                        <li class="list-group-item">House Number: {{$client->shipping_house_number}}</li>
                        @if($client->shipping_house_number_addition)
                            <li class="list-group-item">House Number Addition: {{$client->shipping_house_number_addition}}</li>
                        @endif
                        <li class="list-group-item">Street: {{$client->shipping_street}}</li>
                        <li class="list-group-item">City: {{$client->shipping_city}}</li>
                        <li class="list-group-item">Country: {{$client->shipping_country}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card card-default">
                <div class="card-header">
                    <h5 class="pull-left mt-2">Your Last Order</h5>
                    <a href="/orders" role="button" class="btn btn-outline-primary pull-right">Go to all order</a>
                </div>
                <div class="card-body">
                    @if($order)
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order placed at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="/orders/{{$order->order_id}}">{{$order->order_id}}</a></td>
                                    <td>&euro; {{number_format($order->order_price, 2)}}</td>
                                    <td>{{$order->order_status}}</td>
                                    <td>{{date_format($order->created_at, 'd-m-Y H:i')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>You haven't made any ordrs yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
        @include('inc.finish-registration')
    @endif
@endsection