# ApiDocs #

### What is this repository for? ###

ApiDocs is a simple Laravel 5 package that will automatically generate API documentation from your routes.php file.

### Setup ###

Add to the require-dev:
~~~
"paplauskas/apidocs": ">=0.1",
~~~

Run:
~~~
composer update paplauskas/apidocs
or just
composer update
~~~

Finally, add this to the config/app.php 'providers' array
~~~
Paplauskas\ApiDocs\ApiDocsServiceProvider::class,
~~~


Ready!

### How do I use it? ###

If setting up ApiDocs went well, you should be able to access it through /apidocs (for example http://website.dev/apidocs). Default password is "secret".

If you wish to change the password (and you definitely should if your development environment is public), run artisan command "vendor:publish". Now you can edit the default settings in the config/apidocs.php file.

### How to write documentation? ###

Format more or less follows the usual DocBlocks format. Write comments right before the route you wish to document. Example:

~~~
    /**
    * @title Upload an image
    * @description Uploads the original image to the server, resizes it.
    * @group Images
    * @param  file image
    * @return string path
    */
    Route::post('images/upload', 'ImageController@upload');

    /**
    * Get image path
    * Returns image path based on image ID.
    * @group Images
    * @param  int imageID
    * @return string path
    */
    Route::get('images/get/{imageID}', 'ImageController@get');
~~~

As you probably noticed, @ title and @ description are optional tags - the first line is always considered as title. @param, @return can be declared in several lines if you want to. Description line is optional and doesn't have to be specified at all. Use whatever format is more readable to you.


Undocumented routes are ignored.

Package is smart enough to recognise group prefixes, so don't worry about them.

### Found a bug? ###

File an issue in issue tracker.
