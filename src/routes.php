<?php
use Paplauskas\ApiDocs\Parser;

Route::get('apidocs', function() {
    $parser = new Parser();

    return view('apidocs::index', [
        'lastModified' => $parser->getLastModified(),
        'endpoints' => $parser->parseEndpoints(),
    ]);
});