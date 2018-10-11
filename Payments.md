# Payments using Stripe and Laravel Cashier

## Using Stripe Checkout JS
Stripe is system that allows developers to sell products and subscriptions online with ease.  When you create an account, you will have two options in regards to security keys, Live and Demo/TEST.  This is a really nice feature of Stripe as it allows deveopers the opportunity to play around with Stripe without anything actually hitting a bank or seeing any fees.

## Payment Via Stripe Payments -> Checkouts
Checkout securely accepts your customer's payment details and directly passes them to Stripe's servers. Stripe returns a token representation of those payment details, which can then be submitted to your server for use.

[Payment Info and Features]('https://stripe.com/ca/payments/features')

[Payment Checkout Docs]('https://stripe.com/docs/checkout')

Accepting a card payment using Stripe is a two-step process, with a client-side and a server-side action:

1. From your website running in the customer’s browser, Stripe securely collects your customer’s payment information and returns a representative token. This, along with any other form data, is then submitted by the browser to your server.
2. Using the token, your server-side code makes an API request to create a charge and complete the payment.
Tokenization ensures that no sensitive card data ever needs to touch your server, so your integration can operate in a PCI-compliant way. Card details are never fully revealed, although Stripe’s Dashboard and API do provide limited information about the card (such as its last four digits, expiration date, and brand).

## Easiest Way - HTML/JS Widget for Checkout

Stripe offers a very easy way to get started accepting payments using a Javascript widget.  For this widget, you will need to add your own stripe DATA-KEY, which can be live or test key from your account


#### Here is an example/template of the Checkout Widget

```html
<form action="your-server-side-code" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_TYooMQauvdEDq54NiTphI7jx"
    data-amount="999"
    data-name="Stripe.com"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true">
  </script>
</form>
```

**Checkout must be loaded directly from https://checkout.stripe.com/checkout.js. Using a local copy of Checkout is unsupported, and may result in user-visible errors.**

## Response Token
So now that you have the simple form, it is not as easy as just submitting it and your done.  Stripe takes the request and stores all the information in a PCI compliant way so that you don't have to have the hassles and complexity of storing users private information. When the scheckout is successful, Stripe will return a response token, which is not a card number but an identifier key (token) for that card.  

## The charge is performed on the server side
One thing to note is that even though we use the widget, the charge is not performed wioth the widget, the charge is performed on the server side by code we write.   The reason for this is that if the widget send the charge to stripe, anyone could modify the html/js of the widget's source using developer tools and chage how mu=ch is getting charged etc.  So we use the widget's Form Action to a server side script.  In LAravel

**Make a New Controller**
```cmd
php artisan make:controller PurchasesController
```
**Make A Route to the Controller using the Post MEthod**
```php
Route::post('/purchase', 'PurchasesController@store');
```
**And aadjust the for's ACTION to this URI**
AND DON'T FORGET TO ADD A CSRF FIELD TO ALL FORMS
```html
<form action="/purchase" method="POST">
{{ csrf_field() }}
<!-- ... -->
```

This will return a response like this
```
array:4 [▼
  "_token" => "3FmoZpfsyVs6bpVqcREy88MfZN02l4aqV9qgQe7H"
  "stripeToken" => "tok_1DJSSFA5Jj1ONgcbPGKv6aNj"
  "stripeTokenType" => "card"
  "stripeEmail" => "test@test.com"
]
```

## Workflow
So this is how it works
1. Widget Form is submitted using the API Key in data-key to identify the account
2. The form data is sent to the server side "action" script
3. Stripe returns a response with data including the Stripe Token.  This token is a UID to charge that card
4. We need to send this token back to stripe from the server side
5. The form is sent to Stripe again using the returned token and says okay charge the card

Cool, right!

### So How do we send it from the server side? - Stripe PHP Library Way
[Link to Github Stripe PHP Repo]('https://github.com/stripe/stripe-php')
```cmd 
composer require stripe/stripe-php
```

## Stripe PHP Package Workflow
This seems to be straightforward as well
1. Set the API key using the class
```php
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_4eC39HqLyjWDarjtT1zdp7dc");
```
2. Get the Token form the Post
```php
   // Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
//or
$token = $request->stripeToken;
```

3. Create a Customer
```php
$customer = \Stripe\Customer::create([
    'email' => 'test@example.com',
    'token' => $token 
    ]);
```

4. Charge the Card
```php
$charge = \Stripe\Charge::create([
    'customer' => $customer->id,
    'amount' => 5000,
    'currency' => cad
]);
```
## Keys
When using Stripe, you have both tesst and live keys.  If using Laravel, the services config will indicate what Stripe requires and you can safely store these keys as ENV vars.
```php
//in config/services.php
 'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
```


#### Stripe 'Key' is the Publishable key
**Publishable Key** 
#### Stripe 'Secret' is the secret key
**Secret Key** 

When the Stripe SDK asks for the ApiKey, it is referring to the secret key

- Source means the stripe token from the call

## Steps for making a simple payment form
1. Create a form using the stripe widget
2. Create a crf token using 
```html
{{ csrf_token() }}
```
3. Add the Stripe Class to the controller
```php
//php 7
use Stripe\{Stripe,Charge,Customer};
//php 5
use Stripe\Stripe as Stripe;
use Stripe\Customer as Customer;
use Stripe\Charge as Charge;

```

4. Set the ApiKey either in the controller method or in the controller constructor
**Use the Stripe Secret Key stored in ENV and config>services**
```php
Stripe::setApiKey(config('services.stripe.secret'));
```
5. Create the Stripe\Customer
```php
   $customer = Customer::create([
        'email' => request('stripeEmail'),
        //Source is just the stripe token
        'source' => request('stripeToken'),
    ]);
```

6. Create the charge using Stripe\Charge class
```php
 $charge =  Charge::create([
        'customer' => $customer->id,
        'amount' => 50,
        'currency' => 'CAD'
    ]);
```
7. Calbacks
```php
 if($charge->status == 'succeeded'){
        return "It Worked for $" . $charge->amount . ' in the currency of ' . $charge->currency;
    }
```

#### Whole Code

**Index.html**
```html
     <form action="/purchases" method="POST">
                    {{ csrf_field() }}
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      {{-- The Key from Stripe --}}
                      data-key="pk_test_m1W44gg2T3oBoVtbv3eNdXy9"
                      {{-- Amount of the payment in cents --}}
                      data-amount="500"
                      {{-- Name of the product --}}
                      data-name="Some Product Okay"
                      {{-- Descritpion of the product --}}
                      data-description="This is a description of some product"
                      {{-- Image to use in the checkout form --}}
                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"

                      data-locale="auto"
                      {{-- Added Security to verify zip/postal --}}
                      data-zip-code="true">
                    </script>
 </form>
 ```
 **PurchasesController**
 ```php
 public function store(){
    // 1.  Set up API key
    // You can also add it to a constructor function as well
    Stripe::setApiKey(config('services.stripe.secret'));

    //2.  Create a customer
    //and in real life we would look to store this customer id in the database for future reference and charges
    $customer = Customer::create([
        'email' => request('stripeEmail'),
        //Source is just the stripe token
        'source' => request('stripeToken'),
    ]);

    //3. Create a Charge
   $charge =  Charge::create([
        'customer' => $customer->id,
        'amount' => 50,
        'currency' => 'CAD'
    ]);

    if($charge->status == 'succeeded'){
        return "It Worked for $" . $charge->amount . ' in the currency of ' . $charge->currency;
    }
}
```



