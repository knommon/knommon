@extends('layouts/main')

@section('content')
	{{ Form::open(['url' => 'project/edit', 'autocomplete' => 'off', 'class' => 'pure-form pure-form-stacked']) }}

	{{-- If there are errors, show them here --}}
	@if ($error = $errors->first('password'))
	<div class="error">
		{{ $error }}
	</div>
	@endif

	{{ Form::label('title', 'Project Title') }}
	{{ Form::text('title', Input::old('title'), ['placeholder' => 'My New Project', 'class' => 'pure-input-1']) }}
	{{ Form::label('description', 'Project Description') }}
	{{ Form::password('description', ['placeholder' => 'I am working on a project to...', 'class' => 'pure-input-1']) }}
	{{ Form::submit('Save', ['class' => 'pure-button pure-button-primary pure-input-1']) }}

	{{ Form::close() }}
@stop

@section('scripts')
	<script src="//polyfill.io"></script>
@stop