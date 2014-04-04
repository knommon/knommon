@extends('layouts/main')

@section('content')

<div class="row">
	<div class="front-center">
		<h1> About Knommon </h1>
	</div>
		<p class="text-center">Knommon is a platform for creating and sharing projects. <br>
		Find something, find people, find what you need.</p>
	<div class="front-center">
		<h3>And Get Working.</h3>
	</div>
	<div class="front-center">
	<a href="{{ url('/projects/create') }}" class="btn btn-primary">Create a Project</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-8">
		<h2> Why?</h2>
		<p>We love learning. Sitting and listening never quite worked though &mdash; we had to actually get our hands dirty to really
		get it. We made the site so that anyone who learns through projects can find like-minded people to work with.</p>

		<h2>Projects!</h2>
		<p>Projects do a few cool things. For one, they <strong>bring people together.</strong> We at knommon love community, and 
			as cool as the distributed world is, we like person-to-person interaction in real life &mdash; especially when that interaction
			means working on cool stuff with a diverse team. Second, projects <strong>force you to confront skill gaps.</strong> In a 
			class or from a book, you can sometimes sneak by without a complete understanding. When you have to actually make it happen,
			you know you will understand it. </p>

		<h2>Resources!</h2>
		<p>We <strong>integrated resources</strong> into the site so that you and your teammates can keep track of what is useful or inspiring. 
			If you get stuck, check out similar projects and the resources they used. You might find something that's just perfect 
			for what you need!</p>

		<p>Once you are done, you get to show off your work and your new skills. If you want to show off
			to anyone, just send them a link to your project page.</p>


	</div>
	<div class="col-xs-4">
	{{-- image here --}}			
	</div>
</div>

{{-- @todo: make the about page an alias for our project page for knommon? --}}
{{-- We should see what we want with this section. Also, images on this page!!

<div class="row">
	<div class="col-xs-6"></div>
	<div class="col-xs-6">
		<h2> Team </h2>
		<p><strong>Rob Cobb</strong> is all about changing the way education works. Like the system, man. Yeah.</p>
		
		<p><strong>Nick Aversano</strong> learned all he knows from doing projects, and wants kids like him to learn and be great!</p>

	</div>
</div> --}}

<div class="row">
	<div class="col-xs-8">
		<h2> Get in touch</h2>
		<p>We are just getting started, and we love feedback! Bugs, features you'd like to see, life advice &mdash; we want all
		 of it. Have questions or need tips on a project? We'd be happy to help with that too! </p>
		 <p class="text-center"><a href="mailto:hello@knommon.com">Send Us an Email</a></p> 
	</div>
</div>

@stop