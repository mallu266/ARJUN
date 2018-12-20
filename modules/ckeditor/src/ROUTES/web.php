<?php

$namespace = "ARJUN\CKEDITOR\CONTROLLERS";
Route::group(['prefix' => 'ckeditor', 'middleware' => 'web', 'namespace' => $namespace], function () {
    Route::get('/', 'CKEDITORCONTROLLER@login');
   
});
