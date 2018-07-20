# Laravel Structure

**App:** This directory is the meat of the application and contains the core code.

**Console:** This directory contains all the custom Artisan commands created using make:command

**Exceptions:** This directory contains the application’s exception handler and is a good place to add custom exception classes to handle different exceptions thrown by your application

**Http:** This directory contains all your controllers, middleware and requests

**Providers:**  This directory contains all your service providers for the application. You can know more about service providers here

**Bootstrap:**  This directory contains framework bootstrap as well as configuration files. It also contains Cache directory which contains framework generated cache files

**Config:**  This directory contains all your application’s configuration files.

**Database:** This directory contains all database migrations and seeds. You can also store SQLite database file here

**Public:** This directory contains assets like images, js files and CSS.

**Resources:** This directory contains all view files and LESS or SASS files. It also contains lang directory to store language files.

**Routes:** This directory contains all routes definitions for the application. php is the file which receives all the requests to your application and here you can redirect the requests to their respective controller methods.

**Storage:** This directory contains blade templates, session files, cache files and other.

**Tests:** This directory contains all the test files

**Vendor:** This directory contains all composer dependencies

## App
This is where most of the programming will happen.  this folder includes our controllers and models

 - ### Models and Controllers
 Models are placed in the root level of the app folder and controllers are inside the HTTP/Controllers folder in the app folder

## Config
This is where we would go to add or change our applications configuration parameters


## Public
This is where you put the application assets like images and scripts (JS and CSS)

##Database
This folder will handle creating and modifying the database including migrations and seeding the database with dummy data

## Vendor 
this is where all the application's dependencies are located, like third party libraries

##**Important**
One thing to keep in mind with the **PUBLIC** folder is that once we deploy our app to production environment, we should point our web server document root to the *index.php* file located in the reosurces folder.  The reason for this is that this file is the entry point for our whole application. The is the file in charge of loading laravel into memory and basically loading our application. 