@extends('layouts/main')


@section('content')

<div class="page-header">
	<h1>Knommon Projects <br> <small> Here's what we've been working on!</small></h1>
</div>

 <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ url('/projects/create') }}" class="btn btn-primary">New Project</a>
        </div>
    </div>

@if ($projects->isEmpty())
        <p>There are no projects! :(</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->about }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td>
                        <a href="{{ action('ProjectController@getEdit', $project->id) }}" class="btn btn-default">Edit</a>
                        <a href="{{ action('ProjectController@getDelete', $project->id) }}" class="btn btn-danger">Delete</a>
                        <a href="{{ action('ProjectController@getProject', $project->id) }}" class="btn btn-default">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@stop