# Composer Notes
Composer is a great tool for adding third party libraries to your php application.  It can also help with autoloading as well.

## What is Autoloading
[Article Link]('https://www.sitepoint.com/autoloading-and-the-psr-0-standard/')
[Another Good Link]('http://ditio.net/2008/11/13/php-autoload-best-practices/')
 Every time you want to use a new class in your PHP project, first you need to include this class (using include or require).  However if you have __autoload function defined, inclusion will handle itself.

 

## Download Composer
Windows installer:
Visit https://getcomposer.org/download/ and download the Composer-Setup.exe

## Creating a Project with Composer
```
composer create-project project/project
```


## Create a Composer file and require packages
```
echo > composer.json
```

or

``` 
composer init
```

In composer.json
```json
{
  "require": {
    	"facebook/php-sdk": "3.2.*",
        "twig/twig": "1.*",
  }
}
```

```
composer instal
```

## Install Packages

You can search packagist.org for packages

```
composer require php-sdk
```

## Using packages with autoload
```php
require_once 'vendor/autoload.php'

```

[Nice Article on the basics of composer]('https://www.codementor.io/jadjoubran/php-tutorial-getting-started-with-composer-8sbn6fb6t)


 
 


