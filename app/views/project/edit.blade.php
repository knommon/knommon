@extends('layouts/main')

@section('content')
	<div class="page-header">
        <h1>Edit Your Project <small>and stay up to date</small></h1>
    </div>
    {{ Form::open(array('url' => action('ProjectController@update', $project->id), 'method' => 'put')) }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $project->title }}"  />
            @if ($error = $errors->first('title'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="tagline">Tagline</label>
            <input type="text" class="form-control" name="tagline" value="{{ $project->tagline }}"/>
            @if ($error = $errors->first('title'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" name="about">{{ $project->about }}</textarea>
            @if ($error = $errors->first('about'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
           <label for="tags">Tags (comma-separated)</label>
           <input type="text" class="form-control" name="tags" value="{{ implode(', ', $project->tagNames()) }}" />
           @if ($error = $errors->first('tags'))
                <div class="error"> {{ $error }} </div>
           @endif
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
        <a href="{{ action('ProjectController@show', $project->id) }}" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
@stop
