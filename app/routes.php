<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::post('/message', function()
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api-http.littlebitscloud.cc/devices/".$_ENV['CLOUDBIT_ID']."/output");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "duration_ms=30000");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $_ENV['CLOUDBIT_TOKEN']));
  $response = curl_exec($ch);
  curl_close($ch); 

  $resp = Response::make('<Response><Message>Merry Christmas</Message></Response>', 200);

  $resp->header('Content-Type', 'text/xml');

  return $resp;
});
