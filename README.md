# Laravel-Notes

## Creating a project
```cmd
composer create-project --prefer-dist laravel/laravel nameOfProject
```

this installs laravel using PHP 5.6, you can also do this for PHP 7 dependencies
    
```cmd
laravel new nameOfProject
```

## Laravel Server
to start the Laravel server do this
```cmd
php artisan serve
```

## Routes
- all routes are in the folder Routes in the web.php file.  This determines how your application handles responses
### Route Example
```php
// route to the root of the app with '/'
Route::get('/', function () {
//return the view 'welcome; from the folder resources->views->welcome.php
    return view('welcome');
});

```