# Laravel-Notes

## Creating a project
```cmd
composer create-project --prefer-dist laravel/laravel nameOfProject
```

this installs laravel using PHP 5.6, you can also do this for PHP 7 dependencies
    
```cmd
laravel new nameOfProject
```

Important.  if you get an error running php artisan migrate warning you about the user table existing.  do this:

Add this to the AppServiceProvider.php file

```php
use Illuminate\Support\Facades\Schema;

public function boot(){  

Schema::defaultStringLength(191);

}
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

#### NOTE: name your tables with plural in mind and model in singualr form and eloquent will associate the mdoel with the db
#### EG. Database name: tasks  Model name: Task

## Building SCHEMAS in the migration file
The table builder contains a variety of column types that you may use when building your tables:

**Command** |  **Description**
--- | ---
$table->bigIncrements('id');	|  Incrementing ID using a "big integer" equivalent
$table->bigInteger('votes');	| BIGINT equivalent to the table
$table->binary('data');	| BLOB equivalent to the table
$table->boolean('confirmed');  | 	BOOLEAN equivalent to the table
$table->char('name', 4);	|  CHAR equivalent with a length
$table->date('created_at');  | 	DATE equivalent to the table
$table->dateTime('created_at');	| DATETIME equivalent to the table
$table->decimal('amount', 5, 2);	| DECIMAL equivalent with a precision and scale
$table->double('column', 15, 8);  | 	DOUBLE equivalent with precision, 15 digits in total and 8 after the decimal point
$table->enum('choices', ['foo', 'bar']);  | 	ENUM equivalent to the table
$table->float('amount');  |  FLOAT equivalent to the table
$table->increments('id');  |  Incrementing ID to the table (primary key)
$table->integer('votes');  |  INTEGER equivalent to the table
$table->json('options');  |  JSON equivalent to the table
$table->jsonb('options');  |  JSONB equivalent to the table
$table->longText('description');  |  LONGTEXT equivalent to the table
$table->mediumInteger('numbers');  |  MEDIUMINT equivalent to the table
$table->mediumText('description');  |  MEDIUMTEXT equivalent to the table
$table->morphs('taggable');  |  Adds INTEGER taggable_id and STRING  taggable_type
$table->nullableTimestamps();  |  Same as timestamps(), except allows NULLs
$table->smallInteger('votes');  |  SMALLINT equivalent to the table
$table->tinyInteger('numbers');  |  TINYINT equivalent to the table
$table->softDeletes();  |  Adds deleted_at column for soft deletes
$table->string('email');  |  VARCHAR equivalent column
$table->string('name', 100);  |  VARCHAR equivalent with a length
$table->text('description');  |  TEXT equivalent to the table
$table->time('sunrise');  |  TIME equivalent to the table
$table->timestamp('added_on');  |  TIMESTAMP equivalent to the table
$table->timestamps();  |  Adds created_at and updated_at columns
$table->rememberToken();  |  Adds remember_token as VARCHAR(100) NULL
->nullable()  |  Designate that the column allows NULL values
->default($value)  |  Declare a default value for a column
->unsigned()  |  Set INTEGER to UNSIGNED


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


## Getting From DB
To get items from the DB in Tinker, you can do CRUD tasks and view the db
```cmd
php artisan tinker

//Get all Entries
App\Task::all();

//Get a certain record
App\Task::where('id', 1)->get();

*Dont forget the get() part or nothing will be fetched
```

### Create a Record in Tinker
```cmd
$task = new App\Task;

$task->name = "Task Name";
$task->save();
```


## Controllers
- Controllers are used to receive a request and it will figure out how to complie the result

- Controller Layer Delegates
- Model Layer is responsible for the domain and fetching any dat we require
- The presentation layer is the html and views

A simple controller looks like this

```php
Route::get('/task', 'TaskController@methodName');
//stating a request and calling a controller file the '@' then the method name in the controller
```

### Making a controller in Artisan
```cmd
php artisan make:controller TasksController

// to call help on this use
php artisan make:controller -h

```

### Things to Leanr More About 
- Query Scopes
```php
//Model Method
public function isComplete(){
 return App\Task::where('id', 0);
}
// call is using App\Task::isComplete

or use scope method by prepending a function name with 'scope'
public function scopeiscomplete($query, $value){
return $query->where('complete', 1)->get();
}
```
# Some things to know
1. Sometimes when deleting a file, like a model or migration, the autoload can cause when running artisan commands.  To fix this run:

```cmd
composer dump-autoload
```
- This dumps all of the app's autoload files and refreshes them

