@extends('layouts/main')

@section('title')
	{{ $user->fname }}'s Profile | @parent
@stop

@section('content')
	<div class="profile">
		<img src="{{ $user->photo_url or '/images/profile-default.png' }}" width="100" height="100" />
	</div>

	<h1 class="title">{{ $user->fname }} {{ $user->lname }}</h1>
	<a href="{{ action('UserController@getEditProfile', $user->id ) }}" class="btn btn-primary">Edit</a>
	<h3>About me</h3>
		<p> {{ $user->about }} </p>		
	<div>
		<p><h3>Skills</h3></p>
	
	<div class="tags skills">
    	@foreach($skills as $tag)
    		<span class="tag skill"><a href="{{ URL::route('tag.show', array('slug' => $tag['tag_slug'])) }}" class="btn btn-default">{{ $tag['tag_name'] }}</a></span>
    	@endforeach
  	</div>

	<p><h3>Interests</h3></p>
	<div class="tags interests">
    	@foreach($interests as $tag)
    		<span class="tag interest"><a href="{{ URL::route('tag.show', array('slug' => $tag['tag_slug'])) }}" class="btn btn-default">{{ $tag['tag_name'] }}</a></span>
    	@endforeach
  	</div>  	

	<p><h3>Projects</h3></p>
	<div class="tags projects">
    	@foreach($projects as $project)
    		<span class="tag project"><a href="{{ URL::route('project.show', array('id' => $project->id, 'slug' => $project['tag_slug'])) }}" class="btn btn-default">{{ $project->title }}</a></span>
    	@endforeach
  	</div>  	

</div>
@stop