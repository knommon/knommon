<?php

if (Config::get('app.debug')) {
	Event::listen('illuminate.query', function($query, $bindings, $time, $name){
		Log::info($query."\n");
		Log::info(json_encode($bindings)."\n");
	});
}

HTML::macro('clever_link', function($route, $text) {
	if (strpos(Request::path(), $route) !== false) {
		$active = "class = 'active'";
	} else {
		$active = '';
	}

	return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
});
