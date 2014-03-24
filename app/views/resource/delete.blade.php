@extends('layouts/main')

@section('content')
	  <div class="page-header">
        <h1>Delete {{ $resource->name }} <small>Are you sure?</small></h1>
    </div>
    {{ Form::open(array('url' => action('ResourceController@destroy', $resource->id), 'method' => 'delete')) }}
        <input type="hidden" name="resource" value="{{ $resource->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('ResourceController@index') }}" class="btn btn-default">No way!</a>
    {{ Form::close() }}

@stop