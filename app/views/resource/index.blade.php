@extends('layouts/main')


@section('content')

<div class="page-header">
	<h1>Knommon Resources <br> <small> Here's what we've been using to work on our skills!</small></h1>
</div>

 <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ url('/resources/create') }}" class="btn btn-primary">Add a Resource</a>
        </div>
    </div>

@if ($resources->isEmpty())
        <p>There are no resources... Darn!</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resources as $resource) 
                <tr>
                    <td>{{ $resource->name }}</td>
                    <td><a href="{{ $resource->url }}" class="btn btn-primary">Check it out!</td>
                    <td>{{ $resource->updated_at }}</td>
                    <td>
                        <a href="{{ action('ResourceController@getEdit', $resource->id) }}" class="btn btn-default">Edit</a>
                        <a href="{{ action('ResourceController@getDelete', $resource->id) }}" class="btn btn-danger">Delete</a>
                        <a href="{{ action('ResourceController@getResource', $resource->id) }}" class="btn btn-default">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@stop