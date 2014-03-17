@extends('layouts/main')

@section('content')
	{{ Form::open(['url' => 'user/login', 'autocomplete' => 'off', 'class' => 'pure-form pure-form-stacked']) }}

	{{-- If there are errors, show them here --}}
	@if ($error = $errors->first('password'))
	<div class="error">
		{{ $error }}
	</div>
	@endif

	{{ Form::label('email', 'Email') }}
	{{ Form::text('email', Input::old('email'), ['placeholder' => 'john@smith.com', 'class' => 'pure-input-1']) }}
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'pure-input-1']) }}
	{{ Form::submit('Login', ['class' => 'pure-button pure-button-primary pure-input-1']) }}

	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop