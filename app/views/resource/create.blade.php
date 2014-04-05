@extends('layouts/main')

@section('content')
  <div class="page-header">
    <h1>Add a Resource <small>help the community!</small></h1>
  </div>

  {{ Form::open(array('url' => action('ResourceController@store') . '?project=' . Input::get('project'), 'method' => 'post' )) }}
    <input type="hidden" name="project" value="{{ Input::get('project') }}" />
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" value="{{ Input::old('name') }}" />
      @if ($error = $errors->first('name'))
        <div class="error"> {{ $error }} </div>
      @endif
    </div>
    <div class="form-group">
      <label for="url">Link</label>
      <input type="text" class="form-control" name="url" value="{{ Input::old('url') }}"/>
    </div>
    <div class="form-group">
      <label for="body">Body</label>
      <textarea class="form-control" name="body">{{ Input::old('body') }}</textarea>
      @if ($error = $errors->first('body'))
        <div class="error"> {{ $error }} </div>
      @endif
    </div>
    <div class="form-group">
            <label for="tags">Tags (comma-separated)</label>
            <input type="text" class="form-control" name="tags">{{ Input::old('tags') }}</textarea>
            @if ($error = $errors->first('tags'))
                <div class="error"> {{ $error }} </div>
            @endif
        </div>
    <input type="submit" value="Create" class="btn btn-primary" />
    <a href="{{ URL::previous() }}" class="btn btn-link">Cancel</a>
  {{ Form::close() }}
@stop
