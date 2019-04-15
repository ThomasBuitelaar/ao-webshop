@extends('layouts.app')

@section('content')
	<h4>Payment</h4>
	<div class="row">
		<div class="col-12">
			@if(Session::get('paymentMethod') == 'ideal')
				<h1>IDEAL</h1>
			@elseif(Session::get('paymentMethod') == 'paypal')
				<h1>PayPal</h1>
			@else
				<p>Payment is already complete or the session is closed</p>
			@endif
			@if(Session::has('paymentMethod'))
				<p><b>&euro; {{$order->order_price}}</b></p>
				{{ Form::open(['action' => ['OrdersController@update', $order->order_id], 'methode' => 'POST']) }}
					{{Form::hidden('_method', 'PUT')}}
					{{Form::submit('Pay', ['class' => 'btn btn-success'])}}
				{!! Form::close() !!}
			@endif
		</div>
	</div>
@endsection