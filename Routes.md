# Routes in Laravel

## _<span style="color: red;"/>IMPORTANT!  NEVER USE APPLICATION OR BUSINESS LOGIC INSIDE A ROUTE</span>_

Routes in Laravel are like traffic cops for the application.  The routes decide on how to handle URI's in your application

**Note:  Laravel always expects a response to be sent to the browser, whether JSON or HTML**

The most basic Laravel routes accept a *URI* and a *Closure*, providing a very simple and expressive method of defining routes:

```php
Route::get('foo', function () {
    return 'Hello World';
});
``` 
This would mean that if we went to the url *http://example.com/foo* the web page would show a string that says "Hello World" like what was returned via the Route.


## Simple Routes

### Return a html element
```php
Route::get('/', function(){
    return '<h3>Stacks on stacks on stacks</h3>';
});
```

### Return a View
For this example lets assume the user types in _example.com/_ to get to our homepage and we want to show a welcome screen
```php
Route::get('/', function(){
    return view('welcome');
});
```
This will look in the resource folder for a blade view file like _welcome.blade.php_

## Passing Data to the View in a Route
Sometimes we want to return a view but also pass data to it as well.  Here is an example using an associative array
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