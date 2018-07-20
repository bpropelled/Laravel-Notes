# Routes in Laravel

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