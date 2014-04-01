@extends('layouts/main')

@section('title')
  {{$project->title}} | Knommon
@stop

@section('content')
  @if ($status = Session::get('status'))
    <div class="alert alert-success">{{ $status }}</div>
  @endif
  <h1>{{ $project->title }}<small class="tagline"> {{ $project->tagline }}</small></h1>
  <div class="about">
    <p>{{{ $project->about }}}</p>
  </div>
  @if ($isMember)
    <p><a href="{{ action('ProjectController@edit', $project->id) }}" class="btn btn-default">Edit</a></p>
  @else
    <div class="form-group">
      <a href="{{ action('UserController@getJoin', $project->id) }}" class="btn btn-primary">Join</a>
      @if ($follows)
        Following<a href="{{ action('UserController@getUnfollow', $project->id) }}" class="btn btn-link">Unfollow</a>
      @else
        <a href="{{ action('UserController@getFollow', $project->id) }}" class="btn btn-link">Follow</a>
      @endif
    </div>
  @endif
  <div class="team">
    @foreach ($team as $member)
      <div class="member">
        <a href="{{ action('UserController@getProfile', $member->id) }}">
          <img src="{{ $member->photo_url or '/images/profile-default.png' }}" width="100" height="100" />
          <span class="name">{{ $member->fname }}</span>
        </a>
      </div>
    @endforeach
  </div>
  @if ($isMember)
    <div class="action">
      {{ Form::open(array('url' => action('ResourceController@create'), 'method' => 'get')) }}
        <input type="hidden" name="project" value="{{ $project->id }}" />
        <input type="submit" value="Add a Resource" class="btn btn-primary" />
      {{ Form::close() }}
    </div>
  @endif
  
  @if (($resources = $project->resources) && !$resources->isEmpty())
    <div class="row tile-row resources">
      @foreach ($resources as $resource)
          <div class="thumbnail resource">
            <div class="caption">
              <h3><a href="{{{ $resource->url }}}" target="_blank">
                  {{{ $resource->name }}}
              </a></h3>
              <p>{{{ $resource->body }}}</p>
              @if ($isMember)
                <div class="actions">
                  <a href="{{ action('ResourceController@edit', $resource->resource_id) }}" class="btn btn-default">Edit</a>
                  <a href="{{ action('ResourceController@confirm', $resource->resource_id) }}" class="btn btn-danger">Delete</a>
                </div>
              @endif
            </div>
        </div>
      @endforeach
    </div>
  @else
    There are no resources related to this project yet.
  @endif
@stop
