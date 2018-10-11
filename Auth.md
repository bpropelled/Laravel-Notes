# Auth Notes

## scaffold Auth into the application
To scaffold a aut login suite, simply use the command from Artisan, it is that easy
```cmd 
php artisan make:auth
```
then
```cmd 
php artisan migrate
```

## Redirect Views when User is not logged in
When you have views that you don't want to be accessed by someone who is not logged in and you want to redirect them automatically to a login page, simply use the included Auth middleware in your route
**For Single Route
```php
Route::get('/profile','ProfileController@index')->middleware('auth')
```
**Or For Multiple Routes or a Route Group 
```php
Route::group(['middleware' => ['auth']], function() {
    // your routes
});
```
## Auth Middleware in Controller Construct
Using the auth middleware in ChatsController's __contruct() indicates that all the methods with the controller will only be accessible to authorized users. 

```php
public function __construct()
{
  $this->middleware('auth');
}
```