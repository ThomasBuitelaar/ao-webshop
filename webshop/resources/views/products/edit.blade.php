@extends('layouts.app')

@section('content')
	<h1>Edit Product</h1>
	{!! Form::open(['action' => ['ProductsController@update', $product->product_id], 'methode' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		<div class="form-group">
			{{Form::label('name', 'Name')}}
			{{Form::text('name', $product->product_name, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('description', 'Description')}}
			{{Form::textarea('description', $product->product_description, ['class' => 'form-control'])}}
		</div>

		<div class="row">
			<div class="col-6">
				<div class="form-group">
					{{Form::label('price', 'Price')}}
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">&euro;</span>
						</div>
						{{Form::number('price', $product->product_price, ['class' => 'form-control', 'step' => '.01'])}}
					</div>
				</div>
			</div>
			
			<div class="col-6">
				<div class="form-group">
					{{Form::label('discount-percentage', 'Discount percentage')}}
					<div class="input-group">
						{{Form::number('discount-percentage', $product->product_discount_percentage, ['class' => 'form-control'])}}
						<div class="input-group-append">
							<span class="input-group-text">&#37;</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			{{Form::label('media', 'Photos and videos')}}
			<div class="custom-file">
				{{Form::file('media', ['class' => 'form-control custom-file-input', 'accept' => 'video/*, image/*'])}}
				{{Form::label('media', 'Choose photo or video', ['class' => 'custom-file-label'])}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('category[]', 'Category')}}
			{{Form::select('category[]', $options, $selectedOptions, ['class' => 'form-control', 'multiple' => 'multiple'])}}
		</div>

		<label for="specification-name">Specifications</label>
		@php($specRow = 0)
		@foreach($specifications as $k=>$v)
			<div class="row" id="specifications">
				<div class="col-6">
					<div class="form-group">
						{{Form::label('specification-name_'.$specRow, 'Specification name', ['class' => 'specification-name'])}}
						{{Form::text('specification-name_'.$specRow, $k, ['class' => 'form-control'])}}
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						{{Form::label('specification-value_'.$specRow, 'Specification value', ['class' => 'specification-name'])}}
						@if($v === true)
							{{Form::text('specification-value_'.$specRow, 'True', ['class' => 'form-control'])}}
						@elseif($v === false)
							{{Form::text('specification-value_'.$specRow, 'False', ['class' => 'form-control'])}}
						@else
							{{Form::text('specification-value_'.$specRow, $v, ['class' => 'form-control'])}}
						@endif
					</div>
				</div>
			</div>
			@php($specRow++)
		@endforeach
		<div class="mb-3">
			<button id="addSpecRow" class="btn btn-outline-primary">Add specification row</button>
		</div>
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Submit', ['class' => 'btn btn-primary pull-left mb-2'])}}
	{!! Form::close() !!}
	<a href="#" role="button" class="btn btn-danger pull-right mb-2" data-toggle="modal" data-target="#confirm-delete">Delete</a>

	@include('inc.delete-modal')
@endsection