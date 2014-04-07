<?php
return array(
	"base_url"   => URL::to('/') . "/social/auth",
	"providers"  => array(
		"Google"     => array(
			"enabled"    => true,
			"keys"       => array( "id" => $_ENV['GOOGLE_ID'], "secret" => $_ENV['GOOGLE_SECRET']),
			),
		"Facebook"   => array(
			"enabled"    => true,
			"keys"       => array( "id" => $_ENV['FACEBOOK_ID'], "secret" => $_ENV['FACEBOOK_SECRET']),
			),
		"Twitter"    => array(
			"enabled"    => true,
			"keys"       => array( "key" => $_ENV['TWITTER_ID'], "secret" => $_ENV['TWITTER_SECRET'])
			),
		),
	"debug_mode" => false,
);
