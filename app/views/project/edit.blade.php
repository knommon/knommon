@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Edit Your Project <small>and stay up to date</small></h1>
    </div>
    <form action="{{ action('ProjectController@postEdit') }}" method="post" role="form">
    <input type="hidden" name="id" value="{{ $project->id }}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $project->title }}"  />
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <input type="text" class="form-control" name="about" value="{{ $project->about }}" />
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
        <a href="{{ action('ProjectController@getIndex') }}" class="btn btn-link">Cancel</a>
    </form>
@stop