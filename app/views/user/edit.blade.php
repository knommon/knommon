@extends('layouts/main')

@section('content')
	<div class="profile">
		<img src="{{ $user->photo_url or '/images/profile-default.png' }}" width="100" height="100" />
	</div>

	<h1 class="title">{{ $user->fname }} {{ $user->lname }}</h1>
	
		{{ Form::open(array('url' => action('UserController@postProfile', $user->id), 'method' => 'post' )) }}
        <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" name="about">{{ $user->about }}</textarea>
            @if ($error = $errors->first('about'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="skills">Skills (comma-separated)</label>
            <input type="text" class="form-control" name="skills" value="{{ implode(', ', $skills) }}"/>
            @if ($error = $errors->first('skills'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <div class="form-group">
            <label for="Interests">Interests (comma-separated)</label>
            <input type="text" class="form-control" name="interests" value="{{ implode(', ', $interests) }}"/>
            @if ($error = $errors->first('interests'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
    {{ Form::close() }}	

@stop