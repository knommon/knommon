@extends('layouts/main')

@section('title')
	{{$project->title}} | Knommon
@stop

@section('content')
	@if ($status = Session::get('status'))
		<div class="alert alert-success">{{ $status }}</div>
	@endif

	<h1>{{ $project->title }}<small> {{ $project->tagline }}</small></h1>
	<p><a href="{{ action('ProjectController@edit', $project->id) }}" class="btn btn-default">Edit</a></p>
	<p>{{{ $project->about }}}</p>
	<p>
	<h3>Resources</h3>
	<table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
				<tr>

				{{Form::open(array('url' => action('ResourceController@create'), 'method' => 'post')) }} 
				<input type="hidden" name="projectid" value="{{ $project->id }}" />
				<input type="submit" value="Add a Resource" class="btn btn-primary" />
				{{Form::close()}}
				
				<!-- At some point we want to arrange these in some order that makes sense-->
				@foreach($project->resources as $resource)
				<tr>
					<td><a href="{{ action('ResourceController@show', $resource->id) }}" >
						{{ $resource->name }}</a></td>
					<td><a href="{{ $resource->url }}">External Link</a></td>
					<td>
					<a href="{{ action('ResourceController@edit', $resource->id) }}" class="btn btn-default">Edit</a>   
                    <a href="{{ action('ResourceController@confirm', $resource->id) }}" class="btn btn-danger">Delete</a>
                    </td>
				</tr>
				@endforeach
	</ul>
	</p>
@stop
