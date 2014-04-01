@extends('layouts/main')

@section('title')
	{{ $user->fname }}'s Profile | @parent
@stop

@section('content')
	<h1 class="title">{{ $user->fname }} {{ $user->lname }}</h1>
	<div class="profile">
		<img src="{{ $user->photo_url or '/images/profile-default.png' }}" width="100" height="100" />
	</div>
@stop