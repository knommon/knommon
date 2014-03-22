@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Edit {{ $resource->name }} </h1>
    </div>


    <form action="{{ action('ResourceController@handleEdit') }}" method="post" role="form">
    <input type="hidden" name="id" value="{{ $resource->id }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $resource->name }}"  />
        </div>
        <div class="form-group">
            <label for="url">Link</label>
            <input type="text" class="form-control" name="url" value="{{ $resource->url }}"/>
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <input type="text" class="form-control" name="about" value="{{ $resource->about }}" />
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-link">Cancel</a>
    </form>
@stop