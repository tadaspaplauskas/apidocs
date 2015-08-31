# ApiDocs #

### What is this repository for? ###

ApiDocs is a simple Laravel 5.1 package that will automatically generate API documentation from your routes.php life.

### How do I get set up? ###

Add at the end of your composer.json file:

~~~
"repositories": [{
    "type": "package",
    "package": {
        "name": "frankly/apidocs",
        "version": "0.1",
        "source": {
            "url": "https://TadasPaplauskas@bitbucket.org/TadasPaplauskas/apidocs.git",
            "type": "git",              
            "reference": "master"
        }
    }
}]
~~~
	
Add to the require-dev/require:
~~~
"frankly/apidocs": ">=0.1",
~~~
	
Add to psr-4:
~~~
"Frankly\\ApiDocs\\": "vendor/frankly/apidocs/app"
~~~

Finally, add this to the config/app.php 'providers' array
~~~
Frankly\ApiDocs\ApiDocsServiceProvider::class,
~~~	
Run:
~~~
composer update frankly/apidocs
or just
composer update```
~~~

Ready!

### How do I use it? ###

If setting up ApiDocs went well, you should be able to access it through /apidocs (for example http://website.dev/apidocs). Default password is "secret".

If you wish to change the password (and you definitely should if your development environment is public), run artisan command "vendor:publish". Now you can edit default settings in the config/apidocs.php file.

### How to write documentation? ###

Format more or less follows the usual DocBlocks format. Write comments right before the route you wish to document. Example:

~~~
    /**
    * @title Upload an image
    * @description Uploads the original image to the server, resizes it.
    * @Group Images
    * @param  file image
    * @return string path
    */
    Route::post('images/upload', 'ImageController@upload');
    
    /**
    * Get image path
    * Returns image path based on image ID.
    * @Group Images
    * @param  int imageID
    * @return string path
    */
    Route::get('images/get/{imageID}', 'ImageController@get');
~~~

As you probably noticed, @title and @description are optional tags - the first line is always considered as title. 
Description line is optional and doesn't have to be specified at all. Use whatever format is more readable to you.

Undocumented routes are ignored.

Package is smart enough to recognise group prefixes, so don't worry about them.

### Found a bug? ###

tadaspaplauskas at gmail
