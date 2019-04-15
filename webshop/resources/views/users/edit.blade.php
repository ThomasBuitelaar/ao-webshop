@extends('layouts.app')

@section('content')
	<h1>Change user details</h1>
	{!! Form::open(['action' => ['UsersController@update', $user], 'methode' => 'POST']) !!}
		{{ csrf_field() }}
    	{{ method_field('patch') }}

		<div class="form-group">
	    	{{Form::label('name', 'Name')}}
			{{Form::text('name', $user->name, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
	    	{{Form::label('surname', 'Surname')}}
			{{Form::text('surname', $user->surname, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('email', 'Email')}}
			{{Form::email('email', $user->email, ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('password', 'Password')}}
			{{Form::password('password', ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('password_confirmation', 'Confirm password')}}
			{{Form::password('password_confirmation', ['class' => 'form-control'])}}
		</div>
		
		{{Form::submit('Save', ['class' => 'btn btn-primary mb-3 mt-3'])}}
	{!! Form::close() !!}
@endsection