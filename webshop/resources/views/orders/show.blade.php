@extends('layouts.app')

@section('content')
	@if($order->client_id_fk === Auth::user()->client->client_id)
		<h1>Order {{$order->order_id}}</h1>
		<div class="row">
			<div class="col-12">
				<p>Status: <b>{{$order->order_status}}</b></p>
			</div>
			<div class="col-12">
				<h4>Products</h4>
				<table class="table table-bordered bg-white">
					<thead>
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Quantity</th>
							<th scope="col">Discount</th>
							<th scope="col">Price</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
							<tr>
								<td>{{$product->product_name}}</td>
								<td>{{$product->pivot->quantity}}</td>
								<td>
									@if($product->product_discount_percentage)
										{{$product->product_discount_percentage}}&#37;
									@endif
								</td>
								<td>&euro; {{number_format($product->pivot->price, 2)}}</td>
							</tr>
						@endforeach
						<tr>
							<td class="text-right" colspan="4">Total Price: &euro; {{number_format($order->order_price, 2)}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	@else
		<p>Non of your orders have this id</p>
	@endif
@endsection