<?php

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::group(["prefix" => "lbum", "namespace" => "libressltd\lbusermanual\controllers", "middleware" => ["web", "auth"]], function(){

	Route::get("/", function() {
		$process = new Process('php artisan vendor:publish --tag=lbusermanual --force');
		$process->run();
	});

	Route::resource("generate", "LBUM_generateController");
	Route::resource("document", "LBUM_documentController");
	Route::resource("document.function", "LBUM_documentFunctionController");
	Route::resource("function.step", "LBUM_functionStepController");

	Route::group(["prefix" => "ajax", "namespace" => "Ajax"], function(){
		Route::resource("document", "LBUM_documentController");
		Route::resource("document.function", "LBUM_documentFunctionController");
		Route::resource("function.step", "LBUM_functionStepController");
	});
});