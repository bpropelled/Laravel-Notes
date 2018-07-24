# Service Providers
#### Laravels Bootstrapping Tool

Service Providers are used to register componenets to be used in the application for :
- service container bindings
- Event listeners
- middleware
- routes

To config service providers on these methods:
- Boot
- Register

## To make a service provider, you can use artisan

    php artisan make:provider ExampleName

The go to you providers folder at App/Http/Providers, open the file it created

The go to root/config/app.php and look for a section for "Providers".  The providers are located in an array 'providers'.

Add an new item to the array with your new service provider you made with artisan

```php
App\Providers\ExampleName::class 
```

