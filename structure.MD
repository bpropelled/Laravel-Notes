# LAravel Structure

App: This directory is the meat of the application and contains the core code.
Console: This directory contains all the custom Artisan commands created using make:command
Exceptions: This directory contains the application’s exception handler and is a good place to add custom exception classes to handle different exceptions thrown by your application
Http: This directory contains all your controllers, middleware and requests
Providers: This directory contains all your service providers for the application. You can know more about service providers here
Bootstrap: This directory contains framework bootstrap as well as configuration files. It also contains Cache directory which contains framework generated cache files
Config: This directory contains all your application’s configuration files.
Database: This directory contains all database migrations and seeds. You can also store SQLite database file here
Public: This directory contains assets like images, js files and CSS.
Resources: This directory contains all view files and LESS or SASS files. It also contains lang directory to store language files.
Routes: This directory contains all routes definitions for the application. php is the file which receives all the requests to your application and here you can redirect the requests to their respective controller methods.
Storage: This directory contains blade templates, session files, cache files and other.
Tests: This directory contains all the test files
Vendor: This directory contains all composer dependencies