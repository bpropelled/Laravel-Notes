##  Eloquent Notes
Eloquent is laravel's Active Record Implementation.  Eloquent provides a clean abstraction from raw SQL code 

### Awesome Cheat Sheet for Eloquent Re
[Eloquent Relationships Cheat Sheet – Hacker Noon](https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209)

## What is Active Record
When it comes to working with data in an application, you are probably going to need an ORM in one form or another. An ORM is the layer between the database and your application. By using an ORM, a lot of the hard work of creating, updating, reading and deleting from the database is taken care for us.

I think for the most part, you don’t need to worry about what type of ORM you are using. The majority of modern frameworks usually ship with an ORM out of the box. Laravel for instance ships with Eloquent.

However as you delve deeper into how applications are designed and built and you start to work on applications that have specific characteristics, it’s worth exploring the different types of ORMs that you have available to you.

The two most popular implementations of ORM are Active Record and Data Mapper. In this article I’m going to be exploring the differences between the two patterns, what are the benefits and drawbacks of choosing one over the other and what you should consider when working with an ORM in your own projects.
-- Source --
[What's the difference between Active Record and Data Mapper?](https://www.culttt.com/2014/06/18/whats-difference-active-record-data-mapper/)

## Models and Database tables
Artisan includes a make command that will generate an Eloquent model for our application.  The model will be used for having methods that work with the database.  When creating a model, it is usually names as a singular reference to the database table.  For example:
    - If we had a database table name ARTICLES, then we would have a model named Article
    - If we had a database table named USERS, we would have a model called User

## Artisan to Make a Model
Here is a simple command for Artisan that will make an Eloquent model for us
```cmd
php artisan make:model Article
```

** By default, models created using Artisan will be placed in the root of the "APP" folder

The above code will create a boilerplate model that inherits the Eloquent class.  The class is "extending" the Model class of the Eloquent Library
``php
<?php

namespace App;
//App is using Model
use Illuminate\Database\Eloquent\Model;
//Class extends the Eloquent Model
class Article extends Model
{
    //
}
```

## Welcome TINKER
Artisan includes a really nice command line interface for interating with your laravel application.  it is called Tinker and it is used like this.
Tinker is a great way to test drive Eloquent methods right before your eyes. 

1. Start Tinker up in the command line
```cmd
php artisan tinker
```

## Creating a DB Record dynamically using Tinker
```cmd
php artisan tinker

//Create an instance of the model
>> $article = new App\Article;

//Add attributes
>> $article->title = 'This is a sample title'
>> $article->body = "This is the body of the friggin article"

//Save the article instance to the DB
$article->save()

//Viola, you will now see a record in the articles table of the database
```

## Viewing  the records in the database using Tinker
```cmd
php artisan tinker
>> App\Article::all();
//or to Array for better viewing
>> App\Article::all()->toArray()
```

## Updating Records is Easy with Tinker
Lets say we are still in the Tinker terminal, any variables we create and use will be available during the session so we can use them again
So let's say we want to update the Article's Title
```cmd
$article->title = "This is the new title"
$article->save();
```
## Select all from Table using Eloquent
** Let's say we want to find all records in a table, in SQL we would usually write **
```sql
select * from articles where id = 1
```
Here is the Eloquent way of doing things
```cmd
$article = App\Article::find(1)
//or
$article->find(1);
```

**Find articles where title equals**
```sql
select * from articles where title = "this is a test title"
```
in Eloquent
```cmd
$article = App\Article::where('title', 'This is a test title')->get()
```

**Using the "GET" method will create a collection of findings.  Collections are like Arrays on steroids**

Here is another way to find the first article that meets that criteria
```cmd
>> $article = App\Article::where('title' , 'this is a test title')->first()
```
This will return the FIRST instance of the criteria

## Using Tinker to create a DB record with all it's attriutes at one.  
This way you can pass the "CREATE" method an array of values to create the new record with
```cmd
>> $article =  App\Article::create(['title' => 'this is a test title', 'body' => "Lorem ipsum']);
//or
>> $article = new App\Article
>> $article->create(['title' => 'this is a test title', 'body' => "Lorem ipsum']);
```
__**NOTE: When using the m,ethod above you will get a T_STRING Error, this is because we are not creating a NEW instance of the class, we are trying to create a method from the class so keep the NEW keyword out**__

__**NOTE: Don't forget to pass in an array eg. dont foget to include the brackets inside the create parenthesis**__

## Mass Assignment Error using the Create Method
When using the create method you might come across an error message about mass assigmnet. Laravel does this to protect us
```cmd
Illuminate/Database/Eloquent/MassAssignmentException with message 'Add [name] to fillable property to allow mass assignment on [App/Author].'
```

**From the documentation in Laravel**
>>You may also use the create method to save a new model in a single line. The inserted model instance will be returned to you from the method. However, before doing >>so, you will need to specify either a fillable or guarded attribute on the model, as all Eloquent models protect against mass-assignment by default.
[Eloquent: Getting Started - Laravel - The PHP Framework For Web Artisans](https://laravel.com/docs/5.3/eloquent#mass-assignment)

#### when deciding what variable to include into the "White List" $fillable variable so they can be mass assigned, figure out what you want the user to change and what you dont.  What you dont want to be mass assigned can be put into a $guarded array.  For example, we would not want the Record ID to be in the $fillable array as we wouldn't want our users to be able to change record IDs.    So if a user tries to do something sneaky, like change the name of an input field to change something they are not supposed to, if the variable is not in the $fillable array, this action will be ignored.  Thanks Laravel, that is pretty cool!

## UPDATE a Record
We saw before how we can make changes to the retrieved record 
```cmd
$author = new App\Author;
$a = $author->find(1);
$a->name = 'Frank';
$a->save();
```

Well just like the CREATE method, we have an UPDATE method where we can do it all at once
```cmd
$author = new App\Author;
$a = $author->find(1);
$a->update(['name' => 'Frank' , 'description' => 'This guy has cool articles']);
```

Notice you don't have to run the save method

## Multiple WHERE clauses
sometimes you may need to have multiple WHERE statements, here is how
```php
$article = App\Article::where('title' , 'this is a test title')->where('id',1)->where('name', 'Brendon');
```


