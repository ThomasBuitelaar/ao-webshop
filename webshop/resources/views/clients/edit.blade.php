@extends('layouts.app')

@section('content')
	<h1>Change user details</h1>
	{!! Form::open(['action' => ['ClientsController@update', $client->client_id], 'methode' => 'POST']) !!}

		<div class="form-group">
			{{Form::label('date-of-birth', 'Date of Birth')}}
			{{Form::date('date-of-birth', new \DateTime($client->date_of_birth), ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('gender', 'Gender')}}
            <select name="gender" id="gender" class="form-control">
                <option class='gender-selector {{$client->gender}}' value="0" disabled>Select Gender</option>
                <option class='gender-selector {{$client->gender}}' value="1" >Male</option>
                <option class='gender-selector {{$client->gender}}' value="2" >Female</option>
                <option class='gender-selector {{$client->gender}}' value="3" >Other</option>
            </select>
		</div>

		<div class="form-group">
			{{Form::label('phone-number', 'Phone Number')}}
			{{Form::text('phone-number', $client->phone_number, ['class' => 'form-control'])}}
		</div>
		
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Save', ['class' => 'btn btn-primary mb-3 mt-3'])}}
	{!! Form::close() !!}
@endsection