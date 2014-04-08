@extends('layouts/main')

@section('title')
Enter Your Email | @parent
@stop

@section('content')
  {{ Form::open(['url' => action('SocialController@postTwitter'), 'autocomplete' => 'off']) }}
    @if (Session::get('error'))
      <div class="error">{{ Session::get('error') }}</div>
    @endif
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" value="{{ Input::old('email') }}">
    </div>
    <div class="form-group">
      <div class="social-buttons social-buttons-register form-group">
        <input type="submit" class="btn twitter" value="Register with Twitter"/>
      </div>
    </div>
  {{ Form::close() }}
@stop