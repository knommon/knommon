@extends('layouts/main')
@section('title')
	Register | @parent
@stop

@section('content')
	<div class="social-buttons social-buttons-register form-group">
		<div class="social-buttons">
			<a href="{{ URL::route('facebook') }}" class="btn btn-default facebook">Register with Facebook</a>
			<a href="{{ URL::route('twitter') }}" class="btn btn-default twitter">Register with Twitter</a>
			<a href="{{ URL::route('google') }}" class="btn btn-default google">Register with Google</a>
		</div>
	</div>
	{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
		<h2 class="form-signup-heading">Create an Account</h2>

		<div class="row">
			<div class="col-lg-6 form-group">
				{{ Form::text('fname', Input::old('fname'), array('class'=>'form-control', 'placeholder'=>'First Name')) }}
			</div>
			<div class="col-lg-6 form-group">
				{{ Form::text('lname', Input::old('lname'), array('class'=>'form-control', 'placeholder'=>'Last Name')) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
			@if ($error = $errors->first('email'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>
		<div class="form-group">
			{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
			@if ($error = $errors->first('password'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>
		<div class="form-group">
			{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
			@if ($error = $errors->first('password_confirmation'))
				<div class="error"> {{ $error }} </div>
			@endif
		</div>

		{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block')) }}
	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop