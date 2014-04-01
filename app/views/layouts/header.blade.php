@section('header')
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    {{-- Brand and toggle get grouped for better mobile display --}}
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Knommon</a>
    </div>

    {{-- Collect the nav links, forms, and other content for toggling --}}
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        {{ HTML::clever_link('projects', 'Projects') }}
        {{ HTML::clever_link('resources', 'Resources') }}
        {{--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>--}}
        </li>
      </ul>
      {{--<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>--}}
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check() && ($user = Auth::user()))
          <li class="dropdown">
            <a href="{{ action('UserController@getProfile', $user->id) }}" class="dropdown-toggle" data-toggle="dropdown">
              {{ $user->fname }}{{--<b class="caret"></b>--}}
            </a>
            {{--<ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
            </ul>--}}
          </li>
          <li><a href="{{ url('user/logout') }}">Logout</a></li>
        @else
          <li><a href="{{ url('user/login') }}">Sign In</a></li>
          <li class="dropdown">
            <a href="{{ url('user/register') }}" class="dropdown-toggle" data-toggle="dropdown">Register</a>
            {{--<ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>--}}
          </li>
        @endif
      </ul>
    </div>{{-- /.navbar-collapse --}}
  </div>{{-- /.container-fluid --}}
</nav>
@show
