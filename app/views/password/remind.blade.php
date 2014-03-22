@extends('layouts/main')
@section('content')
	{{ Form::open(['url' => action('RemindersController@postForgot'), 'autocomplete' => 'off']) }}
		@if (Session::get('error'))
			<div class="error">{{ Session::get('error') }}</div>
		@endif
		@if (Session::get('status'))
			<div class="message"> {{ Session::get('status') }} </div>
		@endif
	    <input type="email" name="email">
	    <input type="submit" value="Send Reminder">
	{{ Form::close() }}
@stop