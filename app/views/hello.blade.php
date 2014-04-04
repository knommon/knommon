@extends('layouts/main')

@section('title')
  @parent | The Knowledge Community
@stop

@section('class') home @stop

@section('header')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-8">
      <h1 class="logo">knommon</h1>
    </div>
    <div class="col-md-4 col-sm-4">
      <div class="signin"><a href="/user/login" class="btn">Sign In</a></div>
    </div>
  </div>
  <div class="row">
    <h2 class="tagline">
      A community of innovators learning by doing, <br>together.
    </h2>
    <div class="section">
      <a href="/projects" class="btn btn-danger">Browse Projects</a>
    </div>
  </div>
</div>

@stop

@section('content')

<div class="section">
  <div class="row video">
    <div class="info">
      <h3>The Knowledge Community</h3>
      <p>If you are not willing to learn, no one can help you. If you are determined to learn, no one can stop you.</p>
    </div>
    
    <iframe class="embed" src="http://embed.ted.com/talks/sir_ken_robinson_bring_on_the_revolution.html" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
  </div>
</div>
<!--What would you do if you knew you couldn't fail?-->
@stop

@section('full-content')

<div class="section">
  <div class="row full-row gray">
    <h3>What is Knommon?</h3>
    <p>Knommon is a platform that connects you to groups of people with similar interests in your area. It's about fostering a community of people who explore what they want to do and provides the resources for them to do so.</p>
  </div>
  <div class="row full-row">
    <h3>Why?</h3>
    <p>You don't need a degree to build great things. In the real world, there aren't any tests. There's no grading and there's certainly no failing. All you have is what you can do with what you know.
    <i>What would you do if you knew you couldn't fail?</i></p>
    <div class="social-buttons social-buttons-register form-group">
      <a href="{{ URL::route('facebook') }}" class="btn btn-default facebook">Register with Facebook</a>
      <a href="{{ URL::route('twitter') }}" class="btn btn-default twitter">Register with Twitter</a>
      <a href="{{ URL::route('google') }}" class="btn btn-default google">Register with Google</a>
      <span class="email-register"><a href="{{ url('user/register') }}">Or Register with Email</a></span>
    </div>
  </div>
</div>

@stop