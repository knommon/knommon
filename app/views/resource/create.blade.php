@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Add a Resource <small>help the community!</small></h1>
    </div>

    {{ Form::open(array('url' => action('ResourceController@store'), 'method' => 'post' )) }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" />
            @if ($error = $errors->first('name'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="url">Link</label>
            <input type="text" class="form-control" name="url" />
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <input type="text" class="form-control" name="body" />
            @if ($error = $errors->first('body'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
        <a href="{{ action('ResourceController@index') }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
@stop
