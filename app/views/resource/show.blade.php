@extends('layouts/main')

@section('title')
	{{$resource->name}} | Knommon
@stop

@section('content')
	<h1><a href="{{ $resource->url }}">{{ $resource->name }}</a></h1>
	<p>{{{ $resource->body }}}</p>
@stop
