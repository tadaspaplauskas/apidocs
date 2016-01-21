<?php

Route::post('apidocs/check', 'Paplauskas\ApiDocs\Http\Controllers\ApiDocsController@check');
Route::get('apidocs', 'Paplauskas\ApiDocs\Http\Controllers\ApiDocsController@index');
Route::get('apidocs/login', 'Paplauskas\ApiDocs\Http\Controllers\ApiDocsController@login');
Route::get('apidocs/logout', 'Paplauskas\ApiDocs\Http\Controllers\ApiDocsController@logout');