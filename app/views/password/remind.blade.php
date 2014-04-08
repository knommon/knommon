@extends('layouts/main')

@section('title')
Request New Password | @parent
@stop

@section('content')
  {{ Form::open(['url' => action('RemindersController@postForgot'), 'autocomplete' => 'off']) }}
    @if (Session::get('error'))
      <div class="error">{{ Session::get('error') }}</div>
    @endif
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
      <input type="submit" value="Reset Password" class="btn btn-primary">
    </div>
  {{ Form::close() }}
@stop