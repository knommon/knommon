@extends('layouts/main')


@section('content')

<div class="page-header">
  <h1>Resources <br> <small> Here's what we've been using to work on our skills!</small></h1>
</div>

@if ($resources->isEmpty())
    <p>There are no resources... Darn!</p>
  @else
    <div class="row tile-row resources">
      @foreach ($resources as $resource)
          <div class="thumbnail resource">
            <div class="caption">
              <h3><a href="{{{ $resource->url }}}" target="_blank">
                  {{{ $resource->name }}}
              </a></h3>
              <p>{{{ $resource->body }}}</p>
              <ul>
                @foreach($resource->projects as $project)
                  <li><a href="{{ action('ProjectController@show', $project->id) }}">{{$project->title}}</a></li>
                @endforeach
              </ul>
            </div>
        </div>
      @endforeach
    </div>
  @endif

@stop