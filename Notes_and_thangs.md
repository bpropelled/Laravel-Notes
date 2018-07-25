# Notes and Thangs

This is just a section to keep track of some important notes, tricks, tips and caveats to using Laravel from my experience

## Have a Route Return JSON Response
If you setup a route to return an array, the browser's response will be in JSON format. pretty cool.
```php
Route::get('about', function () {
    $response_array = [];
    $response_array['author'] = 'Bob Sagat';
    $response_array['version'] = '2.0';
    $response_array['note'] = 'this is the notes';
    return $response_array;
});
```
The response in the browser for this will be 
```json
{"author":"Bob Sagat","version":"2.0","note":"this is the notes"}
```
## Returning Data to View - accessing the passed array variables
When you return data to the view using a route method, one thing that tripped me up was this:
```php
Route::get('/home', function(){
    $data = [];
    $data->version = '0.1';
    //Notice data is passed in the view function along with the view file
    return view('welcome', $data);
});
```
Now you can access the $data in the view file using handlebar tags
**_inside welcome.blade.php_**
```html
<h1>Hi This is version {{ $version }} </h1>
```
**_Note: the $data var is passed but the version is accessed using the $version var.  Pretty smart and cool as you would expect to reference it using $data['version'] not just $version._**


## Models don't have to be in the database
Sometimes you just want to have/fetch some static data, like options for a form's dropdown menu.  You can create a model to do so and not have it in a database.  Just create a model without a migration and you are all set.

or use Artisan

    php artisan make:model DropDownOption

## Change LocalHost to a fancy domain
This is a simple trick that is nice to use on a dev environment

For example, when using Xampp or Laravel's Artisan web server, you typically have to go to localhost:8000.  Boring.  So here is a trick to add a fancy url to your local dev on Windows

1. Go to C:\{USER}\windows\system32\drivers\etc\hosts
2. Add a line that goes
```cmd
127.0.0.1 fu.ck
```
3. Fire up server
4. Now go to fu.ck, or for a typical laravel install use fu.ck:8000

**Cool Eh!**

## Make a controller with api boilerplate methods (Show, store,update,destroy)
To do this using artisan, simply add "--api" to the end of the artisan command like so
    php artisan 

## Escaping Characters
In most cases, you want to escape your characters to avoid security risks by embedding code into your app.  When using the template literal syntax for passing data to the view, laravel's default syntax automatically escapes it for you.  this is how you use template literals with auto escape.

```html
<div>{{ $variableName }}</div> 
```
But lets say we want to have unescaped characters like, maybe an html or span element.  Use **__!!__**
do this 
```html
<div>{{ !! $variableName !!}}</div> 
```
## Compact
If you want to convert a group of variables to an associatative array, you can use the compact() method.
```php
$name = 'Tom';
$age = '33';
$sex = 'male';

return view('pages.about')->compact('name','age','sex');
```

The parameters of the compact function look for variables and turns them into an array.

## Blade and Semi-colons
When using blade methods in html, omit the semi colon
eg:
```html
@extends('app')
<!-- And -->
@section('content')
```

