@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Add a Resource <small>help the community!</small></h1>
    </div>


    <form action="{{ action('ResourceController@postCreate') }}" method="post" role="form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" />
        </div>
        <div class="form-group">
            <label for="url">Link</label>
            <input type="text" class="form-control" name="url" />
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <input type="text" class="form-control" name="about" />
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
        <a href="{{ action('ResourceController@getIndex') }}" class="btn btn-link">Cancel</a>
    </form>
@stop

