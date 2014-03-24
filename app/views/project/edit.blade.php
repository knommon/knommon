@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Edit Your Project <small>and stay up to date</small></h1>
    </div>
    {{ Form::open(array('url' => action('ProjectController@update', $project->id), 'method' => 'put')) }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $project->title }}"  />
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <input type="text" class="form-control" name="about" value="{{ $project->about }}" />
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
@stop
