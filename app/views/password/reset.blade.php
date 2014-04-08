@extends('layouts/main')

@section('title')
  Password Reset | @parent
@stop

@section('content')
{{ Form::open(['url' => action('RemindersController@postReset'), 'autocomplete' => 'off']) }}
  @if (isset($error))
    <div class="error">{{ $error }}</div>
  @endif
  <input type="hidden" name="token" value="{{ $token }}">

  <div class="form-group">
    @if ($error = $errors->first('email'))
      <div class='error'> {{ $error }} </div>
    @endif
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" placeholder="john@smith.com">
  </div>

  <div class="form-group">
    @if ($error = $errors->first('password'))
      <div class='error'> {{ $error }} </div>
    @endif
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" placeholder="••••••••••">
  </div>

  <div class="form-group">
    @if ($error = $errors->first('password_confirmation'))
      <div class='error'> {{ $error }} </div>
    @endif
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••••">
  </div>

  <input type="submit" value="Reset Password" class="btn btn-primary">
{{ Form::close() }}
@stop

@section('scripts')
<script src="//polyfill.io"></script>
@stop