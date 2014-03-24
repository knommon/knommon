@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Edit {{ $resource->name }} </h1>
    </div>
    {{ Form::open(array('url' => action('ResourceController@update', $resource->id), 'method' => 'put' )) }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $resource->name }}"  />
        </div>
        <div class="form-group">
            <label for="url">Link</label>
            <input type="text" class="form-control" name="url" value="{{ $resource->url }}"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <input type="text" class="form-control" name="body" value="{{ $resource->body }}" />
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
@stop