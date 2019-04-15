@extends('layouts.app')

@section('content')
	<h1>Products</h1>
	<div class="row">
		@if(count($products) > 0)
			@include('inc.product-card')
		@else
			<p>No products yet</p>
		@endif
	</div>
@endsection