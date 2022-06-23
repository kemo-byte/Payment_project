<?php

// paypal config and settings

return [
	"sandboxclient_ids"=>'go',
	// sandbox
	"sandbox_client_id" => env('PAYPAL_SANDBOX_CLIENT_ID'),
	"sandbox_secret" => env('PAYPAL_SANDBOX_SECRET'),
	
	// live
	
	"live_client_id" => env('PAYPAL_LIVE_CLIENT_ID'),
	"live_secret" => env('PAYPAL_LIVE_SECRET'),
	
	// paypal SDK configurations
	
	"settings" => [
	"mode" => env('PAYPAL_MODE', 'sandbox'),
	"http.ConnectionTimeOut"=>3000,
	"log.logEnabled" => true,
	"log.FileName" => storage_path().'/logs/paypal.log',
	"log.loglevel" => 'DEBUG'
	
	]
];