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

