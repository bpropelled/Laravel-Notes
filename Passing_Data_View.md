# Passing Data to the View

This section is a brief introduction on how to get dynamic content passed to your views

For static pages, it is good practice to have a PagesController to handle the page methods for the routing eg.

```php
    Route::get('/about', 'PagesController@about');
```
This route will look for the 'about' method inside the PagesController
