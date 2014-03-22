<?php
return array(
	"base_url"   => URL::to('/') . "/social/auth",
	"providers"  => array(
		"Google"     => array(
			"enabled"    => true,
			"keys"       => array( "id" => "388329424484-jt3gq2u1rtjnbcvorp2e0sfsre25tc8o.apps.googleusercontent.com", "secret" => "z6poCBfPFwLiTXgI2AR54nfb"),
			),
		"Facebook"   => array(
			"enabled"    => true,
			"keys"       => array( "id" => "557395844368353", "secret" => "90aa8e19b850f356d94ce450a9b58356"),
			),
		"Twitter"    => array(
			"enabled"    => false,
			"keys"       => array( "key" => "ID", "secret" => "SECRET")
			),
		),
	"debug_mode" => false,
);
