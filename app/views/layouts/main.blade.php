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
<body>
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
			@yield('content')
		</div>
	</div>
	<footer>
	<div class="footer">
		@include('layouts/footer')
	</div>
	</footer>
	@section('scripts')
	@show
</body>
</html>
