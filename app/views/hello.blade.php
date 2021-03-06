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
    @if (Auth::check())
      <div class="signin text-center">
      <a href="/user/profile/{{Auth::user()->id}}" class="btn">Welcome Back!</a>
      </div>
      @else
      <div class="signin"><a href="/user/login" class="btn">Sign In</a></div>
      @endif
    </div>
  </div>
  <div class="row">
    <h2 class="tagline">
      What do you want to create?
    </h2>
    <div class="section">
      <div class="search col-md-8">
        <form action="/projects" method="get">
          <input type="text" class="form-control" placeholder="ex. Community Garden" />
          <div class="buttons">
            <a href="/projects" class="btn btn-danger">Browse Projects</a>
            <a href="/projects/create" class="btn btn-default">New Project</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('content')

<div class="section">
  <div class="row video">
    <div class="info">
      <h2 class="tagline">Community of Doers</h2>
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
    <h3>Knommon = Knowledge Community</h3>
    <p>Knommon is a platform for creating and sharing projects. Connect with people to learn and grow, to build new things. <br> The Knommon community supports each other. We share useful and inspiring resources, help each other when we get stuck, and connect to build amazing things.</p>
  </div>
  <div class="row full-row">
    <h3>Why?</h3>
    <p>You don't need a degree to build great things. In the real world, there aren't any tests. There's no grading and there's certainly no failing. All you have is what you can do with what you know. <i>What would you do if you knew you couldn't fail?</i></p>

    <div class="row">
      <div class="social-buttons social-buttons-register form-group">
        <a href="{{ URL::route('facebook') }}" class="btn facebook">Register with Facebook</a>
        <a href="{{ URL::route('register.twitter') }}" class="btn twitter">Register with Twitter</a>
        <a href="{{ URL::route('google') }}" class="btn google">Register with Google</a>
        <span class="email-register"><a href="{{ url('user/register') }}">Or Register with Email</a></span>
      </div>
    </div>
  </div>
</div>

@stop