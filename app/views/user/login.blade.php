@extends('layouts/main')

@section('title')
	Sign In | @parent
@stop

@section('content')
	<h2>Sign In</h2>
	{{ Form::open(['url' => 'user/login', 'autocomplete' => 'off', 'class' => 'pure-form pure-form-stacked']) }}
		@if ($error = $errors->first('form'))
			<div class="error"> {{ $error }} </div>
		@endif

		{{ Form::label('email', 'Email:') }}
		{{ Form::text('email', Input::old('email'), ['placeholder' => 'john@smith.com', 'class' => 'pure-input-1']) }}
		@if ($error = $errors->first('email'))
			<div class="error"> {{ $error }} </div>
		@endif

		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password', ['placeholder' => '••••••••', 'class' => 'pure-input-1']) }}
		@if ($error = $errors->first('password'))
			<div class="error"> {{ $error }} </div>
		@endif

		{{ Form::checkbox('remember', '1', true) }}
		{{ Form::label('remember', 'Remember Me') }}

		{{ Form::submit('Sign In', ['class' => 'pure-button pure-button-primary pure-input-1']) }}

	{{ Form::close() }}
	<a href="{{ URL::route('facebook') }}" class="btn btn-default">Login with Facebook</a>
	<a href="{{ URL::route('google') }}" class="btn btn-default">Login with Google</a>
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop
