<?php

Route::group(["prefix" => "lbum", "namespace" => "libressltd\lbusermanual\controllers"], function(){
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