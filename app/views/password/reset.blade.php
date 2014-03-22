@extends('layouts/main')

@section('content')
	{{ Form::open(['url' => action('RemindersController@postReset'), 'autocomplete' => 'off']) }}
		@if (isset($error))
			<div class="error">{{ $error }}</div>
		@endif
		<input type="hidden" name="token" value="{{ $token }}">

		@if ($error = $errors->first('email'))
			<div class='error'> {{ $error }} </div>
		@endif
		<label for="email">Email</label>
		<input type="email" name="email" placeholder="john@smith.com">

		@if ($error = $errors->first('password'))
			<div class='error'> {{ $error }} </div>
		@endif
		<label for="password">Password</label>
		<input type="password" name="password" placeholder="••••••••••">

		@if ($error = $errors->first('password_confirmation'))
			<div class='error'> {{ $error }} </div>
		@endif
		<label for="password_confirmation">Confirm Password</label>
		<input type="password" name="password_confirmation" placeholder="••••••••••">

		<input type="submit" value="Reset Password">
	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop