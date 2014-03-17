@extends('layouts/main')
@section('content')
    {{ Form::open(['route' => 'user/request', 'autocomplete' => 'off']) }}
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', Input::get('email'), ['placeholder' => 'john@example.com']) }}
    {{ Form::submit('reset') }}
    {{ Form::close() }}
@stop

@section('scripts')
    <script src="//polyfill.io"></script>
@stop