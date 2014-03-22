@extends('layouts/main')

@section('title')
	{{$project->title}} | Knommon
@stop

@section('content')
	<h1>{{ $project->title }}</h1>
	<p>{{ $project->about }}
	</p>
@stop
