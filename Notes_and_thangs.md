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

## Use the Built in CARBON library to do current date time
Laravel comes with a date/time library builtin called Carbon.  Carbon is friggin sweet and has a bunch of cool methods to work with.  
```php
$right_now = Carbon\Carbon::now();
```

## Aborting the Response
Sometimes when using a URI in a route , you can use a cool method called "abort()" and pass it a response, in this case, it will send the user to a 404 page if the id is not found. that is if there is no article with the passed id from the URI
```php
//in routes/web.php
Route::get('articles/{id}', 'ArticlesController@show');
//in the Controller
    public function show($id){
        $article = Article::find($id);
            if($article){
                return view('articles.show')->with('article', $article);
            }else{
                abort(404);
            } 
    } 
```

**But even better is that Laravel already has a method for this purpose called FindorFail**

```php
//in the Controller
    public function show($id){
        $article = Article::findOrFail($id);
                return view('articles.show')->with('article', $article);
    } 

```

## Use dynamic a href
Let's say you are using URIs and you need to include a link to each article in html, there are a couple ways you can do this

**Using a URI**
```html
@foreach ($articles as $a)
    <h1><a href="{{ $a->id }}">{{ $a->title }}</a></h1>
    <p>{{ $a->body }}</p>
@endforeach
```
**Using a Controller Method**
```html
@foreach ($articles as $a)
    <h1><a href="{{ action('ArticlesController@show', [$a->id]) }}">{{ $a->title }}</a></h1>
    <p>{{ $a->body }}</p>
@endforeach
```

**Using a URL Function**
```html
@foreach ($articles as $a)
    <h1><a href="{{ url('/articles', $a->id) }}">{{ $a->title }}</a></h1>
    <p>{{ $a->body }}</p>
@endforeach
```


## Routes are not working
Sometimes I created new routes and controller and views properly but when i go to see them, i get a 404 page.  ::poo:: So after some searching, i found this that did the trick and it relates to the order you place your routes.  weird eh.  The general rule of laravel routing is to __**place specific routes before wildcard routes**__ that are related. 
[Order of routes in web.php](https://laracasts.com/discuss/channels/laravel/order-of-routes-in-webphp?page=1)

#### Anything with a parameter should be considered a wildcard,  ####

## Make all items in the model Mass Assignable
As you have learned, when building a model and you want to use the Eloquent create() method to mass assign records to the database you have to identify which of these fields are mass assignable, meaning which of them is the user allowed to change.
```php
$fillable = ['name','title','published_on'];
```
And on the same idea, you can identify which fields SHOULD NOT be mass assignable using the $guarded variable.
```php
$guarded = ['username', 'id', 'post_id'];
```
** But here is a trick if you want all items in your model to be mass assignable without having to declare all the fields in the $fillable array. According to the laravel docs, you can achive this by simply declaring the $guarded variable as an empty array.
```php
$guarded = [];
```
Now all fields of that model are now mass assignable.


## Performance

### N+1 Problem
[Eloquent: Relationships - Laravel - The PHP Framework For Web Artisans](https://laravel.com/docs/5.6/eloquent-relationships#eager-loading)
[The N+1 Problem](https://laracasts.com/lessons/eager-loading)
When working with relational records, one major performance problem will arise when querying the database for records with lots of children records.  What happens with a query like this is that a query will be made to grab the parent records, but all the children records will also have their own query.  So if we had an author with five related children records (books), the query will be 6 (N+1), one fo rthe author and 5 more for the children records.  Imagine if we had hundreds of books or products to query. yikes, homey don't play that.

So Laravel has this nice Eloquent method to use instead of ->all().  The method with the ->with() method and the idea of this method is called ** Eager Loading **

##### Without Eager Loading
```php
$books = App\Book::all();

foreach ($books as $book) {
    echo $book->author->name;
}
```

##### With Eager Loading
```php
$books = App\Book::with('author')->get();

foreach ($books as $book) {
    echo $book->author->name;
}
```

More on Eager Loading and the available methods
[Eloquent: Relationships - Laravel - The PHP Framework For Web Artisans](https://laravel.com/docs/5.6/eloquent-relationships#eager-loading)




