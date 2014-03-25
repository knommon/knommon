@extends('layouts/main')

@section('title')
	Sign In | @parent
@stop

@section('content')
	<h2>Sign In</h2>
	<div class="social-buttons social-buttons-login form-group">
		<a href="{{ URL::route('facebook') }}" class="btn btn-default facebook">Login with Facebook</a>
		<a href="{{ URL::route('google') }}" class="btn btn-default google">Login with Google</a>
	</div>
	{{ Form::open(['url' => 'user/login', 'autocomplete' => 'off', 'class' => 'pure-form pure-form-stacked']) }}
		@if ($error = $errors->first('form'))
			<div class="error"> {{ $error }} </div>
		@endif

		<div class="form-group">
			<label for="email">Email:</label>
			{{ Form::text('email', Input::old('email'), ['placeholder' => 'john@smith.com', 'class' => 'form-control']) }}
			@if ($error = $errors->first('email'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			{{ Form::password('password', ['placeholder' => '••••••••', 'class' => 'form-control']) }}
			@if ($error = $errors->first('password'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>
		<div class="form-group">
			{{ Form::checkbox('remember', '1', true) }}
			<label for="remember">Remember Me</label>
		</div>

		{{ Form::submit('Sign In', ['class' => 'btn btn-primary']) }}

	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop
