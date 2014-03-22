@extends('layouts/main')
@section('title')
	Register | @parent
@stop

@section('content')
	{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
		<h2 class="form-signup-heading">Create an Account</h2>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>

		{{ Form::text('fname', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}
		{{ Form::text('lname', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }}
		{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
		{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
		{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}

		{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block')) }}
	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop