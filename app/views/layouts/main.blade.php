<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>
		@section('title')
			Knommon
		@show
	</title>
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="cleartype" content="on">
	@section('styles')
		<link rel="stylesheet" type="text/css" href="/css/main.css">
	@show
</head>
<body class="@yield('class')">
	<header>
	<div class="header">
		@include('layouts/header')
	</div>
	</header>
	<div class="content">
		<div class="container">
			@if (($error = $errors->first('error')) || ($error = Session::get('error')) || ($error = $errors->first()))
				<div class="error alert alert-danger"> {{ $error }} </div>
			@endif
			@if ($status = Session::get('status'))
			    <div class="alert alert-success">{{ $status }}</div>
			@endif
			@yield('content')
		</div>
		@yield('full-content')
	</div>
	<footer>
	<div class="footer">
		@include('layouts/footer')
	</div>
	</footer>
	{{--<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
	<script>WebFont.load({google: {families: ['Oxygen']}});</script>--}}
	@section('scripts')
	@show
	{{--<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-49730046-1', 'knommon.com'); ga('send', 'pageview');</script>--}}
</body>
</html>
