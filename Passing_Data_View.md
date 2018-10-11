# Passing Data to the View

This section is a brief introduction on how to get dynamic content passed to your views

For static pages, it is good practice to have a PagesController to handle the page methods for the routing eg.

```php
    Route::get('/about', 'PagesController@about');
```
This route will look for the 'about' method inside the PagesController


## Passing a string inside a controller to the view

let say using th above route, you would then have a controller method in the PagesController called about
```php
//inside the PagesController
public function about(){
    return "About Us Page Title';
}
```
## Passing a View to the View using the controller method
Similar to the above example, pass it a view partial
```php

public function about(){
    //use the 'about' view from the views folder - about.blade.php
    return view('about');
}

```

**Or this way if you have this view as a partial inside a folder eg. _views->pages->about_**
```php

public function about(){
    return view('pages.about');
}
```

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
## Passing Data to the view
You can pass the data to the view in a route or controller first like this

```php
    public function about(){
        $name = 'Tom';

        return view('pages.about')->with('name', $name);
    }
```
### Or Like This
    ```php
    public function about(){

        return view('pages.about')->with({
            'name' => 'Tom',
            'age' => '33'
        });
    }
    ```

**When passing an array, every key will be translated to a variable of the same name in the view. So with the above, you could do this:**
```html
    <p>My name is {{ $age }} and I am {{ $age }} years old</p>
```

And another way is to pass a data variable in the view function.

```php
    public function about(){
        $data = [
              'name' => 'Tom',
            'age' => '33'
        ]

        $data['sex']  = 'yes please;

        return view('pages.about', $data);
    }
```
Doing this does the same ting, translates the arrays names to variable names and the values to values.

## Adding Custom CSS and JS that are in the public folder
```html
  <link rel="stylesheet" type="text/css" href="{{asset('css/yourcss.css')}}"/>   
```

## Get PAssword Has
You can get the hashedPassword like this:

$hashedPassword = Auth::user()->getAuthPassword();
And check like this:

if (Hash::check('password', $hashedPassword)) {
    // The passwords match...
}