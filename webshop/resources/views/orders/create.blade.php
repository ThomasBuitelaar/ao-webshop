@extends('layouts.app')

@section('content')
	@if(Auth::user()->client)
	<h1>Order Confirmation</h1>
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered bg-white">
				<thead>
					<tr>
						<th scope="col">Product Name</th>
						<th scope="col">Quantity</th>
						<th scope="col">Discount</th>
						<th scope="col">Price</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						<tr>
							<td>{{$order['item']['product_name']}}</td>
							<td class="text-center">{{$order['qty']}}</td>
							<td class="text-center">
								@if($order['item']['product_discount_percentage'])
									{{$order['item']['product_discount_percentage']}}&#37;
								@endif
							</td>
							<td>&euro; {{number_format($order['price'], 2)}}</td>
						</tr>
					@endforeach
					<tr>
						<th scope="row" colspan="4" class="text-right">Total Price: &euro; {{number_format($cart->totalPrice, 2)}}</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 col-md-6">
			<h4>Shipping address</h4>
			<ul class="list-group list-group-sm">
				{{-- name + surname --}}
				<li class="list-group-item">
					{{Auth::user()->name}} {{Auth::user()->surname}}
				</li>
				{{-- email --}}
				<li class="list-group-item">
					{{Auth::user()->email}}
				</li>
				{{-- street + number + addition --}}
				<li class="list-group-item">
					{{$client->shipping_street}} {{$client->shipping_house_number}} {{$client->shipping_house_number_addition}}
				</li>
				{{-- postal + city --}}
				<li class="list-group-item">
					{{$client->shipping_postal_code}} {{$client->shipping_city}}
				</li>
				{{-- country --}}
				<li class="list-group-item">
					{{$client->shipping_country}}
				</li>
				{{-- phone --}}
				<li class="list-group-item">
					{{$client->phone_number}}
				</li>
			</ul>
			<a href="/clients/edit-shipping-address" role="button" class="btn btn-outline-success mt-3 mb-3">Change</a>
		</div>
		<div class="col-xs-12 col-md-6">
			<h4>Billing address</h4>
			<ul class="list-group list-group-sm">
				{{-- name + surname --}}
				<li class="list-group-item">
					{{Auth::user()->name}} {{Auth::user()->surname}}
				</li>
				{{-- email --}}
				<li class="list-group-item">
					{{Auth::user()->email}}
				</li>
				{{-- street + number + addition --}}
				<li class="list-group-item">
					{{$client->billing_street}} {{$client->billing_house_number}} {{$client->billing_house_number_addition}}
				</li>
				{{-- postal + city --}}
				<li class="list-group-item">
					{{$client->billing_postal_code}} {{$client->billing_city}}
				</li>
				{{-- country --}}
				<li class="list-group-item">
					{{$client->billing_country}}
				</li>
				{{-- phone --}}
				<li class="list-group-item">
					{{$client->phone_number}}
				</li>
			</ul>
			<a href="/clients/edit-billing-address" role="button" class="btn btn-outline-success mt-3 mb-3">Change</a>
		</div>
		<div class="col-12">
			<h4>Payment details</h4>
			{!! Form::open(['action' => 'OrdersController@store', 'methode' => 'POST']) !!}

				<div class="form-check">
					<input class="form-check-input" type="radio" name="PaymentRadio" id="radio-ideal" value="ideal" required>
					<label class="form-check-label" for="radio-ideal">
					IDEAL
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="PaymentRadio" id="radio-paypal" value="paypal">
					<label class="form-check-label" for="radio-paypal">
					PayPal
					</label>
				</div>
				{{Form::submit('Submit', ['class' => 'btn btn-primary mt-3'])}}
			{!! Form::close() !!}
		</div>
	</div>
	@else
		@include('inc.finish-registration')
	@endif
@endsection