@extends('layouts/main')

@section('title')
	{{$resource->name}} | Knommon
@stop

@section('content')
	@if ($status = Session::get('status'))
		<div class="alert alert-success">{{ $status }}</div>
	@endif

	<h1><a href="{{ $resource->url }}">{{ $resource->name }}</a></h1>
	<p>{{{ $resource->body }}}</p>
@stop
