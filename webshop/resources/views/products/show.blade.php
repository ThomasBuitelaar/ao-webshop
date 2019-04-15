@extends('layouts.app')

@section('content')
	
	<h3>{{$product->product_name}}</h3>
	<img class="card-img-top img-thumbnail prod-img" style="max-width:700px;max-height:300px;height: auto;width: auto\9;" src="{{ url('storage/'.$product->product_img) }}" alt="product img">
	@if($product->product_discount_percentage != null)
		<p class="old-price">&euro; {{number_format($product->product_price, 2)}}</p>
		<p>&euro; {{number_format($product->product_price - ($product->product_price * ($product->product_discount_percentage/100)), 2)}}</p>
		<p>{{$product->product_discount_percentage}} &#37;</p>
	@else
		<p>&euro; {{number_format($product->product_price, 2)}}</p>
	@endif
	<p>{{$product->product_description}}</p>

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
	</div>
	<a class="btn btn-outline-primary col-12" href="{{route('product.addToCart', ['id' => $product->product_id])}}" role="button">Put in cart<i class="fa fa-cart-plus"></i></a>
	@if (!Auth::guest())
		<a href="{{$_SERVER['REQUEST_URI']}}/edit" class="btn btn-outline-success" role="button">Edit</a>
	@endif
@endsection