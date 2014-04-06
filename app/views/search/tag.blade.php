@extends('layouts/main')

@section('content')



@if ($projects->isEmpty())
    {{--<p>There are no projects with this tag! :(</p>--}}
@else
    <h2>Projects tagged with {{ $tag }}</h2>
    <div class="row tile-row projects">
        @foreach ($projects as $project)
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail project">
              {{--<img alt="..." src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjE1MCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjE5cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MzAweDIwMDwvdGV4dD48L3N2Zz4=">--}}
              <div class="caption">
                <h3><a href="{{ ($link = URL::route('project.show', array('id' => $project->id, 'slug' => $project->slug))) }}">
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



@if ($resources->isEmpty())
    {{--<p>There are no resources with this tag! :(</p>--}}
@else
<h2>Resources tagged with {{ $tag }}</h2>
    <div class="row tile-row projects">
        @foreach ($resources as $resource)
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail resource">
              {{--<img alt="..." src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjE1MCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjE5cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MzAweDIwMDwvdGV4dD48L3N2Zz4=">--}}
              <div class="caption">
                <h3><a href="{{ $resource->url }}" target="_blank">
                    {{{ $resource->name }}}
                </a></h3>
                <p>{{{ Str::limit($resource->body, 180) }}}</p>
                 
                 @foreach($resource->projects as $project)
                  <li><a href="{{ URL::route('project.show', array('id' => $project->id, 'slug' => $project->slug)) }}">{{$project->title}}</a></li>
                 @endforeach
              
              </div>
            </div>
          </div>
        @endforeach
    </div>
@endif

@if (empty($skills))
    {{--<p>There are no people with this skill tag! :(</p>  --}}
@else
<h2>People tagged with {{ $tag }}</h2>
    <div class="row tile-row projects">
        @foreach ($skills as $user)
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail resource">
              <img src="{{ $user->photo_url or '/images/profile-default.png' }}" width="150" height="150" />
              <div class="caption">
                <h3><a href="{{ action('UserController@getProfile', $user->id) }}" target="_blank">
                {{{ $user->fname }}} {{{ $user->lname }}}
                </a></h3>
                <p>{{{ Str::limit($user->about, 180) }}}</p>
              </div>
            </div>
          </div>
        @endforeach
    </div>
@endif



@stop