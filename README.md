# ApiDocs #

### What is this repository for? ###

A simple plug-and-play Laravel 5 package that will generate a nice API documentation page based on your documented routes.

![List view](https://raw.githubusercontent.com/TadasPaplauskas/apidocs/screenshots/list.PNG "List view")

### Setup ###

Do NOT install this package on your production environment unless you intend to make your API documentation public.

Run this in your project folder:
~~~
composer require paplauskas/apidocs --dev
~~~

Add this to the config/app.php providers:
~~~
Paplauskas\ApiDocs\ApiDocsServiceProvider::class,
~~~

That's it, no additional configuration is involved.

### How do I use it? ###

If setting up ApiDocs went well, you should be able to access it through /apidocs (for example http://website.dev/apidocs).

Please note that you still have to document your endpoints by hand.

### How to write documentation? ###

Just write comments right next to your routes. Api endpoint description format is pretty similar to the usual DocBlocks format. Write comments right before the route you wish to document. Example:

~~~
    /**
    * @title Upload an image
    * @description Uploads the original image to the server, resizes it.
    * @group Images
    * @param  image
    * @param  scale
    * @return stored image url
    */
    Route::post('images/upload', 'ImageController@upload');

    /**
    * Get image
    * Returns image info
    * @group Images
    * @param  imageID
    * @return path
    * @return alt
    * @return width
    * @return height
    */
    Route::get('images/{imageID}', 'ImageController@get');
~~~

As you probably noticed, @ title and @ description are optional tags - the first line is always treated as a title. @param, @return can be declared in several lines if you want to. Description line is optional and doesn't have to be specified at all. Use whatever format is more readable to you.

Package is smart enough to recognise group prefixes, so don't worry about them.

Undocumented routes are ignored.

ApiDocs checks for routes in the usual locations:
* app/Http/routes.php
* routes/api.php
* routes/web.php

### Found a bug? ###

File an issue in issue tracker.
