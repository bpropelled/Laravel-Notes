# Artisan Notes

Artisan is Laravels main development tool.  Artisan can help easily generate **Controllers, Models, Migrations, Seeds, Tests** and many others based on simple templates so we don't have to start from scratch.

Artisan is also helpful by having a built in server to deploy a local laravel application, run database migrations, clear application cache.

## Getting Help with Artisan Commands
If you ever need help or looking for an idea of what a command does you can preceed the command with --help in artisan.  
Example: Need help for make controller commands
    php artisan help make:controller

## Bash Aliases for Artisan
Okay, so typing the php artisan starts to really suck after a while, so here is a trick to make a Bash Alias, you can either type in the command when opening the CMD or save it to a file and run the file each time.  You can also use tools like CMDR and ZSH to save this automatically
```cmd
doskey pa=php artisan $*
```
**Now you just have to use pa like this**
    pa serve
which is the equivalent of 
    php artisan serve

##  Integrated Web Server
### Run the Web Server using Artisan
    php artisan serve 
    
## Maintenance Modes
### Put the application in **Maintenance Mode**.  This is useful when making changes or hot fixes to an application in production.  Simply take it down to make the changes
   
    php artisan down 
   

### Take the application out of maintenance mode 
    
    php artisan up 
    
## App Cache
### Clearing the Application Cache 
When making changes to the application, some times things can get cached and not shown in the recent changes you have made to the application 
    php artisan cache:clear 

## Controllers
### Create Controller using Artisan
    php artisan make:controller ControllerName

*One thing to notes is the style of the controller name.  Controller names should start with a capital letter 

##Models
When making models it is important to name them properly and not like a moron.  Name them so it is clear that the name is what they are/do.  Also, don't pluralize the model names **eg. A model for the users of an applcation should be named User**

### Create a Model without any migrations
    php artisan make:model Task

### Create a Model with Migration
    php artisan make:model Task -m
This will create the model file as well as a migration template file for this model

## Views
### To make views with Artisan
- to make views using artisan, go to [https://github.com/svenluijten/artisan-view]('https://github.com/svenluijten/artisan-view')

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



