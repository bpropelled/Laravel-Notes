#Dependency Injection
Dependency injection is the term for adding a class instance to another instance using the class constructor.

### Adding static data for drop down menu in our app.
Let's say we want to retrieve a dropdown menu's options for our application

1. Create a Model (no migration, no DB)

    php artisan make:model DDOption

2.  Add arrray of values to the Model file (app/DDOption.php)
```php
//Removed Eloquent association by removing ''extends Model''
class DDOptions 
{
   protected  $titles = ['Mr','Mrs','Miss', 'Shithead'];
}
```

Revisit this section