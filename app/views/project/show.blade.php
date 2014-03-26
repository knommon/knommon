@extends('layouts/main')

@section('title')
	{{$project->title}} | Knommon
@stop

@section('content')
	@if ($status = Session::get('status'))
		<div class="alert alert-success">{{ $status }}</div>
	@endif
	<h1>{{ $project->title }}<small class="tagline"> {{ $project->tagline }}</small></h1>
	@if ($isMember)
		<p><a href="{{ action('ProjectController@edit', $project->id) }}" class="btn btn-default">Edit</a></p>
	@else
		<div class="form-group">
			<a href="{{ action('UserController@getJoin', $project->id) }}" class="btn btn-primary">Join</a>
			@if ($follows)
				Following<a href="{{ action('UserController@getUnfollow', $project->id) }}" class="btn btn-link">Unfollow</a>
			@else
				<a href="{{ action('UserController@getFollow', $project->id) }}" class="btn btn-link">Follow</a>
			@endif
		</div>
	@endif
	<div class="team">
		@foreach ($team as $member)
			<div class="member">
				<a href="#">
					<img src="{{ $member->photo_url or '/images/profile-default.png' }}" width="100" height="100" />
					<span class="name">{{ $member->fname }}</span>
				</a>
			</div>
		@endforeach
	</div>
	@if ($isMember)
		{{Form::open(array('url' => action('ResourceController@create'), 'method' => 'post')) }} 
			<input type="hidden" name="project_id" value="{{ $project->id }}" />
			<input type="submit" value="Add a Resource" class="btn btn-primary" />
		{{Form::close()}}
	@endif
	<table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
			<!-- At some point we want to arrange these in some order that makes sense-->
			@foreach($project->resources as $resource)
			<tr>
				<td><a href="{{ action('ResourceController@show', $resource->id) }}" >{{ $resource->name }}</a></td>
				<td><a href="{{ $resource->url }}">External Link</a></td>
				<td>
				<a href="{{ action('ResourceController@edit', $resource->id) }}" class="btn btn-default">Edit</a>   
                <a href="{{ action('ResourceController@confirm', $resource->id) }}" class="btn btn-danger">Delete</a>
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop
