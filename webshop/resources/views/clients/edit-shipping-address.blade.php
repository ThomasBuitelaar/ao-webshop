@extends('layouts.app')

@section('content')
	<h1>Change shipping address details</h1>
	{!! Form::open(['action' => ['ClientsController@updateShippingAddress', $client->client_id], 'methode' => 'POST']) !!}


		<div class="form-group">
			{{Form::label('postal-code', 'Postal Code')}}
			{{Form::text('postal-code', $client->shipping_postal_code, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('house-number', 'House Number')}}
			{{Form::text('house-number', $client->shipping_house_number, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('house-number-addition', 'House Number Addition')}}
			{{Form::text('house-number-addition', $client->shipping_house_number_addition, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('street', 'Street')}}
			{{Form::text('street', $client->shipping_street, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('city', 'City')}}
			{{Form::text('city', $client->shipping_city, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('country', 'Country')}}
			{{Form::text('country', $client->shipping_country, ['class' => 'form-control'])}}
		</div>
		
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Save', ['class' => 'btn btn-primary mb-3 mt-3'])}}
	{!! Form::close() !!}
@endsection