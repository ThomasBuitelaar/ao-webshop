@extends('layouts.app')

@section('content')
	@if(Auth::user()->client)
	<h1>Orders</h1>
	<div class="row">
		<div class="col-12">
			@if(count($orders) > 0)
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
						@foreach($orders as $order)
							<tr>
								<td><a href="/orders/{{$order->order_id}}">{{$order->order_id}}</a></td>
								<td>&euro; {{number_format($order->order_price, 2)}}</td>
								<td>{{$order->order_status}}</td>
								<td>{{date_format($order->created_at, 'd-m-Y H:i')}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p>No orders found</p>
			@endif
		</div>
	</div>
	@else
        @include('inc.finish-registration')
    @endif
@endsection