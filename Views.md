# Views in Laravel

## Using Partials
Partials are a nice way to split up the structure of your app in more managable ways.  Let's say you have a webpage, with header, content and footer.  Typically thhe main layout view file will have it all but maybe you want to break it out so you can just modify the heaer easily

**In Main Layout File
```html
@extend('layout')
<body>
    <!--m Include Header PArtial in PArtials/Header.blade.php -->
@includes('partials/header')
@content
@includes('partials/footer')
</body>
```

## Href Link in HTML using Blade to a route
You can include dynamic url generation using blade for links and link it to a route
```html
 <li class="nav-item">
    <a href="{{ url('profile') }}">Home</a>
    <!-- OR -->
    <a href="{{ route('profile)}}">PRofile</a>
</li>
```

## Check to see if logged in user or guest in Blade
```html
@guest
<h1>Guest </h1>
@else
<h1>logged in user</h1>
@endguest

<!-- OR This Way -->
@auth
    // Your code
@endauth


```
Or add it into a script
```php
<!-- Or using it in the script -->
if (Auth::check()) {
    // The user is logged in...
}
```


## Adding Assets Dynaically 
If you want to add a dynamic link to a css or js file or image, you can use the {{ asset() ]] directive}} and it will rpoint to the resources folder

```html
    <script src="{{ asset('js/app.js') }}" defer></script>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <img href="{{ asset('img/logo.jpg') }} />  
```