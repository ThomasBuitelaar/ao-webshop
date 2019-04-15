@extends('layouts.app')

@section('content')
	<h1>Finish registration</h1>
	{!! Form::open(['action' => 'ClientsController@store', 'methode' => 'POST']) !!}
		<div class="form-group">
            <label for="date-of-birth" class=" control-label">Date of Birth</label>

            <div class="">
                <input id="date-of-birth" type="date" class="form-control" name="date-of-birth" required>
            </div>
        </div>

         <div class="form-group">
            <label for="gender" class=" control-label">Gender</label>

            <div class="">
                <select name="gender" id="gender" class="form-control">
                    <option class='gender-selector' value="0" selected disabled>Select Gender</option>
                    <option class='gender-selector' value="1">Male</option>
                    <option class='gender-selector' value="2">Female</option>
                    <option class='gender-selector' value="3">Other</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class=" control-label">Phone Number</label>

            <div class="">
                <input id="phone" type="tel" class="form-control" name="phone"
                minlength="10" maxlength="13" placeholder="+31 612345678" required>
            </div>
        </div>
        {{--Address inputs--}}
        <hr>
        <div class="form-group">
            <label for="postal-code" class=" control-label">Postal Code</label>

            <div class="">
                <input id="postal-code" type="text" class="form-control" name="postal-code" required>
            </div>
        </div>

        <div class="form-group">
            <label for="house-number" class=" control-label">House Number</label>

            <div class="">
                <input id="house-number" type="text" class="form-control" name="house-number" required>
            </div>
        </div>

        <div class="form-group">
            <label for="house-number-addition" class=" control-label">House Number Addition</label>

            <div class="">
                <input id="house-number-addition" type="text" class="form-control" name="house-number-addition">
            </div>
        </div>

        <div class="form-group">
            <label for="street" class=" control-label">Street</label>

            <div class="">
                <input id="street" type="text" class="form-control" name="street" required>
            </div>
        </div>

        <div class="form-group">
            <label for="city" class=" control-label">City</label>

            <div class="">
                <input id="city" type="text" class="form-control" name="city" required>
            </div>
        </div>

        <div class="form-group">
            <label for="country" class=" control-label">Country</label>

            <div class="">
                <input id="country" type="text" class="form-control" name="country" required>
            </div>
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection