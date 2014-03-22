@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Create A New Project <small>and get working</small></h1>
    </div>


    <form action="{{ action('ProjectController@handleCreate') }}" method="post" role="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" />
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <input type="text" class="form-control" name="about" />
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-link">Cancel</a>
    </form>
@stop