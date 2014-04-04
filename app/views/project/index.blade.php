@extends('layouts/main')

@section('content')

<div class="page-header">
	<h1>Projects <br> <small> Here's what we've been working on!</small></h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <a href="{{ url('/projects/create') }}" class="btn btn-primary">New Project</a>
    </div>
</div>

@if ($projects->isEmpty())
    <p>There are no projects! :(</p>
@else
    <div class="row tile-row projects">
        @foreach ($projects as $project)
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail project">
              {{--<img alt="..." src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjE1MCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjE5cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MzAweDIwMDwvdGV4dD48L3N2Zz4=">--}}
              <div class="caption">
                <h3><a href="{{ ($link = action('ProjectController@show', $project->id)) }}">
                    {{{ $project->title }}}
                </a></h3>
                <p>{{{ Str::limit($project->about, 180) }}}</p>
                <span class="location"></span>
              </div>
            </div>
          </div>
        @endforeach
    </div>
@endif

@stop
