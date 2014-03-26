@extends('layouts/main')


@section('content')

<div class="page-header">
	<h1>Knommon Resources <br> <small> Here's what we've been using to work on our skills!</small></h1>
</div>


@if ($resources->isEmpty())
        <p>There are no resources... Darn!</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Projects that use this</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <!-- I think I am doing an N+1 operation here, and should eager load. Thankfully, n=10-->
                @foreach($resources as $resource) 
                <tr>
                    <td>{{ $resource->name }}</td>
                    <td><a href="{{ $resource->url }}" class="btn btn-primary">Check it out!</a></td>
                    <td> 
                        <ul>
                        @foreach($resource->projects as $project)
                            <li><a href="{{ action('ProjectController@show', $project->id) }}">{{$project->title}}</a></li>
                        @endforeach
                     </td>
                    <td>
                        <a href="{{ action('ResourceController@edit', $resource->id) }}" class="btn btn-default">Edit</a>
                        <a href="{{ action('ResourceController@confirm', $resource->id) }}" class="btn btn-danger">Delete</a>
                        <a href="{{ action('ResourceController@show', $resource->id) }}" class="btn btn-default">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@stop