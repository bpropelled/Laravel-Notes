## Middelleware

Middlware is like a ticket to an amusment park, at somepoint before entering the par (your app) you will have to go through security.  Security will review your ticket (the request) and also check that you meet certain criteria, like are you bringing in outside food or are you wearing any clothes etc.  The ticket will determine what you are allowed and not allowed to do.

So in our app, let's say we have a controller method that we only want to be accessible by guests who haven't logged in yet.  You use the Auth::guest() method from the Auth class

```php
use Auth;
//tiketController
if (Auth::guest()){
        return view('home), HomeController@index');
}
```
OR maybe we want to redirect Guests to a certain page if they are guests, but you want to return a different view for logged in users
```php

use Auth;

public function index(){
    if(Auth::guest()){
        return redirect('guest.home');
    }

    return view('users.home');
}
```

Now this is the basic way to do things, but you can imagine as the app grows larger, you will probably be using this in many places in the app so it would become redunadant if we had to keep using this over and over. Luckily there is a better way.

Middleware can be refered to an onion, when your request enters the application, there are so many layers it has to peel awy to get the the core


## Default Middleware
Laravel installs with two middleware classes **In App\HTTP\Middleware**
- Authenticate.php
- RedirectAuthenicated.php

## Registering Middleware
Middleware is registed in the **Kernal.php** file located in **APP\HTTP\Kernal.php.

In this fiel you will see two properties
- $middleware
- $routedMiddleware

### $Middleware Array
By default any middleware declared in this array, **ALL** requests go through them 

### $routesMiddleware
This is where route middleware is defined.

## Using Middleware in a Controller
If you want to use middleware in a controller you use the __construct method

```php 
class Example extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
}

```

This would mean that any request to the controller will require it to pass through the auth middleware.  the middleware('auth') is a reference to the $routeMiddleware array with the auth key.

Again, adding this will require every request to this controller to go through the auth layer.

## Using middleware only on specific controller methods
Let's say you dont want every one of your controller methods to use the auth layer

You add an array as a callback to the contruct method using the "only' =>'index'

```php 
class Example extends Controller {

    public function __construct(){
        $this->middleware('auth', ['only' => 'create']);
    }
}

```

This says only use the auth middleware on the create method in the controller.  cool 

**Now you can do it the other way as well, so exlcuding certain methods form the auth layer** with the "except" method instead of "only"
```php 
class Example extends Controller {

    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
    }
}

```

## Using Middleware in the Route

So in addition to the above ways of using middleware you can also attach middleware directly to the route instead of using it in the controller

routes/web.php

```php

Route::get('create',['middleware' => 'auth', 'uses' => 'ArticlesController@create']);

```

So this says if a request comes in for exmaple/com/create it will run the middleware 'auth' (from the Kerpnal.php) and 'use' the articles controller create method.

If you are not planning on returning a controller, you can even add middle are tot he route as well

```php
Route::get('create', ['middleware' => 'auth', function(){

    return "this will only show if the user is authitcad";
}]);
```

### TL;DR
#### If you want to attach middleware TO ALL REQUESTS, we use the **Kernal.php's $middleware** properties
#### If you only want middleware for **CERTAIN ROUTES AND CONTROLLER METHODS** then you would use the **Kernal.php's $routeMiddleware** properties