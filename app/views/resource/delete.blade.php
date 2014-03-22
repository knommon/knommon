@extends('layouts/main')

@section('content')
	  <div class="page-header">
        <h1>Delete {{ $resource->name }} <small>Are you sure?</small></h1>
    </div>
    <form action="{{ action('ResourceController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="resource" value="{{ $resource->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('ResourceController@index') }}" class="btn btn-default">No way!</a>
    </form>

@stop