@extends('layouts/main')

@section('content')
	  <div class="page-header">
        <h1>Delete {{ $project->title }} <small>Are you sure?</small></h1>
    </div>
    {{ Form::open(array('url' => action('ProjectController@destroy', $project->id), 'method' => 'delete')) }}
    	<input type="hidden" name="project" value="{{ $project->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-default">No way!</a>
    {{ Form::close() }}

@stop