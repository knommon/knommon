@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Create A New Project <small>and get working</small></h1>
    </div>

    {{ Form::open(array('url' => action('ProjectController@store'), 'method' => 'post' )) }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ Input::old('title') }}"/>
            @if ($error = $errors->first('title'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" name="about">{{ Input::old('about') }}</textarea>
            @if ($error = $errors->first('about'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
        <a href="{{ action('ProjectController@index') }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
@stop