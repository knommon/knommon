@extends('layouts/main')

@section('title')
	Project Page | @parent
@stop

@section('content')
	<div class="container">
		<h1>Project Name</h1>
	</div>
	
	<div class="container">
		<h3>Team</h3>
		<div class="container">
			<ul>
				<li>Rob</li>
				<li>Nick</li>
				<li>Stephen</li>
			</ul>
		</div>
	</div>


    <div class="pure-g">
        <div class="pure-u-1-3">
            <!--
            By default, grid units don't have any margin/padding.
            If you want to add these, put them in a child container.
            -->
            <p><button class="pure-button">Clicky</button> </p>
        </div>

        <div class="pure-u-1-3">
            <p><button class="pure-button">Clacky</button></p>
        </div>

        <div class="pure-u-1-3">
            <p><button class="pure-button pure-button-primary">Save</button></p>
        </div>
    </div>

@stop


@section('scripts')
	<script src="//polyfill.io"></script>
@stop