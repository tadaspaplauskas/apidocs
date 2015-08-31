<?php

Route::post('apidocs/check', 'Frankly\ApiDocs\Http\Controllers\ApiDocsController@check');
Route::get('apidocs', 'Frankly\ApiDocs\Http\Controllers\ApiDocsController@index');
Route::get('apidocs/login', 'Frankly\ApiDocs\Http\Controllers\ApiDocsController@login');
Route::get('apidocs/logout', 'Frankly\ApiDocs\Http\Controllers\ApiDocsController@logout');