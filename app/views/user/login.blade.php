@extends('layouts/main')

@section('title')
	Sign In | @parent
@stop

@section('content')
	<div class="social-buttons social-buttons-login form-group">
		<a href="{{ URL::route('facebook') }}" class="btn btn-default facebook">Login with Facebook</a>
		<a href="{{ URL::route('twitter') }}" class="btn btn-default twitter">Login with Twitter</a>
		<a href="{{ URL::route('google') }}" class="btn btn-default google">Login with Google</a>
	</div>
	<h2>Sign In</h2>
	{{ Form::open(['url' => 'user/login', 'autocomplete' => 'off', 'class' => 'pure-form pure-form-stacked']) }}
		<div class="form-group">
			<label for="email" class="sr-only">Email:</label>
			{{ Form::text('email', Input::old('email'), ['placeholder' => 'Email', 'class' => 'form-control']) }}
			@if ($error = $errors->first('email'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>
		<div class="form-group">
			<label for="password" class="sr-only">Password:</label>
			{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
			@if ($error = $errors->first('password'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>
		<div class="form-group checkbox">
			{{ Form::checkbox('remember', '1', true) }}
			<label for="remember">Remember Me</label>
		</div>

		{{ Form::submit('Sign In', ['class' => 'btn btn-primary']) }}

		<a href="{{ URL::to('password/forgot') }}">Forgot Your Password?</a>

	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop
