@extends('layouts/main')

@section('title')
	{{$project->title}} | Knommon
@stop

@section('content')
	@if ($status = Session::get('status'))
		<div class="alert alert-success">{{ $status }}</div>
	@endif

	<h1>{{ $project->title }}<small> {{ $project->tagline }}</small></h1>

	<p>{{{ $project->about }}}</p>
@stop
