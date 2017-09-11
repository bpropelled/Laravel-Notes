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
//return the view 'welcome; from the folder resources->views->welcome.blade.php
//
Route::get('/', function () {

    return view('welcome');
});

```

- We have two options for routes
### 1. With a closure by using a function callback
```php
Route::get('/', function () {

    return view('welcome');
});
```

or use a view from a subfodler (about->index.blade.php)
```php
Route::get('/about', function(){
   return view('about.index'); 
});
```

### 2. Or direct assign a controller
```php
Route::get('/about', 'ControllerName@controllerMethod');
```



## Working with databases
1. Log into mysql 
```cmd
mysql -u username -p password
```

2. Create a database
```cmd 
create database nameOfDb;
```
- don't forget the semicolons

3. Enter DB
```cmd
use nameOfDb;
```

4. other commands
```cmd
show tables;
```

In the root, there is a file called .env with all the apps dev and prod credentials
- Go into this file and update the creds in the DB section to suit the new db

5. Then run a migration
```cmd
php artisan migrate
```




## Artisan
### to make views with Artisan
- to make views using artisan, go to https://github.com/svenluijten/artisan-view

Usin compsoer
```cmd
$ composer require sven/artisan-view
```
Or add the package to your dependencies in composer.json and run composer update to download the package:

```javascript
{
    "require": {
        "sven/artisan-view": "^1.0"
    }
}
```

Next, add the ArtisanViewServiceProvider to your providers array in config/app.php:

```php
// config/app.php
'providers' => [
    ...
    Sven\ArtisanView\ArtisanViewServiceProvider::class,
];
```
## Create a view

#### Create a view 'index.blade.php' in the default directory
$ php artisan make:view index

#### Create a view 'index.blade.php' in a subdirectory ('pages')
$ php artisan make:view pages.index

## Running Migrations

to get help run
```cmd
php artisan help make:migration
```

- you can run migratiosn to create and manipulate database tables
to make a migration file do:
```cmd
php artisan make:migration migration_name
```

alternatively, you can tell artisan to make the table at the same time by doing this:
```cmd
php artisan make:migration migration_name --create=name_of_table
```

or you can make a model and migration together using this format
```cmd 
php artisan make:model Task -m
```
Even add a controller to the build as well
```cmd
php artisan make:model Task -m -c
```

### NOTE: name your tables with plural in mind and model in singualr form and eloquent will associate the mdoel with the db
#### EG. Database name: tasks  Model name: Task


## Artisan Tinker
- the tinker service is a way to interactiverly interact with your app and db through the command line
To start a Tinker CMD, do this:

```cmd
php artisan tinker
```

An exmaple of interacting with a database using tinker is this.  Say you have a database called "tasks"
```cmd
//Show all records in the tasks database
>> App\Task::all();

//All tasks where ID > 1 and get results
>> App\Task::where('id', '>', '2')->get();

//Get the body of every record
>> App\Task::pluck('task_name');

//Get first of the result using collections helpers 'first()'
>> App\Task::pluck('task_name')->first();

```


