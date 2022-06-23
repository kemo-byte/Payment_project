<?php

// paypal config and settings

return [
	// sandbox
	
	"sandbox.client_id" => env('PAYPAL_SANDBOX_CLIENT_ID'),
	"sandbox.secret" => env('PAYPAL_SANDBOX_SECRET'),
	
	// live
	
	"live.client_id" => env('PAYPAL_LIVE_CLIENT_ID'),
	"live.secret" => env('PAYPAL_LIVE_SECRET'),
	
	// paypal SDK configurations
	
	"settings" => [
	"mode" => env('PAYPAL_MODE', 'sandbox'),
	"http.ConnectionTimeOut"=>3000,
	"log.logEnabled" => true,
	"log.FileName" => storage_path().'/logs/paypal.log',
	"log.loglevel" => 'DEBUG'
	
	]
];