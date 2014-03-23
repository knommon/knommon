@extends('layouts/main')

@section('content')
	  <div class="page-header">
        <h1>Delete {{ $project->title }} <small>Are you sure?</small></h1>
    </div>
    <form action="{{ action('ProjectController@postDelete', $project->id ) }}" method="post" role="form">
        <input type="hidden" name="project" value="{{ $project->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('ProjectController@getIndex') }}" class="btn btn-default">No way!</a>
    </form>

@stop