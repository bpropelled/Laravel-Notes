# Forms in Laravel

So we know how to create views, routes and controllers but how to we get the user to input data eg. create a blog post.  We need to create a front end form for the submissions.

## Using Form's Package
Makes making forms quick and easy.  It can be used using Facades as well.
[Laravel Collective](https://laravelcollective.com/docs/5.2/html)
the  link above is what we are pulling in to our code base when we require the HTML package

```cmd
composer require "laravelcollective/html":"^5.2.0"
```
then
```cmd 
composer install
```
We will mostly use the FormBuilder.php part fof the package.  It includes a Facade class that allows us to use the form builder class more intuitively

Next, add your new provider to the providers array of config/app.php:
```php
  'providers' => [
    // ...
    Collective\Html\HtmlServiceProvider::class,
    // ...
  ],
  ```
Finally, add two class aliases to the aliases array of config/app.php:
```php
  'aliases' => [
    // ...
      'Form' => Collective\Html\FormFacade::class,
      'Html' => Collective\Html\HtmlFacade::class,
    // ...
  ],
  ```

#### Telling laravel to use the facade of the new package
In most packages that provide a laravel hook, you will see a ** Service Provider ** class .  think of this as a laravel specific class that bootstraps things. it registers objects with laravels container, it sets some config, and it can do really whatever you need it to do.

## Using the Form Builder
```html
        <div class="col-lg-12">
            <h1>Add An Article</h1>
            <hr> {!! Form::open(['url' => 'articles']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control'])  !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!} 
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::submit('Submit Your Article', ['class' => 'btn btn-lg btn-danger']) !!}
            </div>
            {!! Form::close() !!}

        </div>

```

The field creator takes 3 arguments 
1. Name of the element
2. The default value
3. Any additional parameters to pass through like Class or Id tags

```html
{!! Form::text('name_of_element', 'Default Value', ['class' => 'form-control']) !!}
```
## Getting Values from Submitted Forms to our Controllers and into the DB
```php
Route::post('articles/create','ArticlesController@show');

//ArticlesController.php
public function store(){

}
```
You have a couple of options, here they are

** Simplest Option - Using a Facade **
```php
//change this
use Illuminate\Http\Request;
//to this
use Request;

    public function store(){
            $input = Request::all();
            return $input;
    }
```
This will return all of the POST data.  here is how you would grab individual field values in the POST
```php
    public function store(){
            $input = Request::get('title');
            return $input;
            //>> 'Part Deux'
    }
```

```php
    public function store(){
        $input = Request::all();
        $add_article =  Article::create($input);
        //or Article::create(['title' => $input['title']);
        if($add_article){
            return redirect('articles');
        }
```
## Form Request Validation Using the FormRequest Class
The for requests class is used for validating the form submission request in your app.

Think of it this way.  Let's say your friends are in a club and you are outside but have to get  a message to them but the bouncer is a dick.  He's luck "fuck off" and your like but i have a message.  So anyways, the bouncer will relay the message but the message must adhere to some of his rules.  These rules are defined in the formRequest Class.  You will give him a message and he will decide whether to relay it to your friends.  like if i's missing something, like a blank required form field, he will let you know or redirect you back to start over.  Let's say he requires an email address,  he will validate your email before submitting it.

The form request class lives in App\Http\Requests.   To create a form request class, use artisan

```cmd 
php artisan make:request createArticlesRequest
```

This will create this file in App\Http\Requests\createArticlesRequest.php

```php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          
        ];
    }
}

```

#### FormRequest ** authorize() ** method
This method will first ask if the submission is allowed, like whether the user is authenticated to make this request.  The default is false,saying the form cant be submitted.  Change this to true to allow the request.
```php
  public function authorize()
    {
        //allow the request
        return true;
 ```
#### FormRequest ** rules() ** method
Here are the rules that the bouncer will use to validate each request.  This will validate the title and body field with a set of rules.
```php
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required'
        ];
    }
```

### Inject the Form Request into the Controller
```php
    public function store(\App\Http\Requests\createArticleRequest $request){
        Article::create($request::all());
        return redirect('articles');
}
```

## Errors Variable
by default all views will have access to a $errors variable
```html 
{{ var_dump($errors ) }}
```

```html
            {!! Form::close() !!}

      
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
```