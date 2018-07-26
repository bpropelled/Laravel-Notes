# Laravel Environment and Configuration

TIn the folder __**config**__, you will find a whole bunch of files for configging your application, including the database.  Each file is very verbose and the comments are very well done to instruct you for what does what.

For example if you are using one of the default DBs like SQLite or MySql, you would go into "config->database.php" file and update the credentials to suit your DB

All of the configuration files for the Laravel framework are stored in the app/config directory. Each option in every file is documented, so feel free to look through the files and get familiar with the options available to you.

Sometimes you may need to access configuration values at run-time. You may do so using the  Config class:

### Accessing A Configuration Value

```php
Config::get('app.timezone');
```
#### You may also specify a default value to return if the configuration option does not exist:
```php
$timezone = Config::get('app.timezone', 'UTC');
```
### Setting A Configuration Value
Notice that "dot" style syntax may be used to access values in the various files. You may also set configuration values at run-time:
```php
Config::set('database.default', 'sqlite');
```
Configuration values that are set at run-time are only set for the current request, and will not be carried over to subsequent requests.

## Adding Your Own Configs
Lets say you want to create your own config files, you can do it by creating the file in the __config__ folder.  The you must Register the new config file into the configuration service Provider like so:

__you have to add the config file placed in config/ to the ConfigServiceProvider__

```php
  public function register()
    {
        config([
            'config/myfile.php',
        ]);
    }
 ```

## Environnement Variables

In your config files, you will; be asked for username and passwords.  Since we don't want the public to see this info, Laravel uses .env files (Environment Variables) to store sensitive info.  For more info, Laravel uses the DotEnv library for this task.

So all your secrets live in the .env file located in the root of the application.  By default Laravel includes a file called example.env with some boilerplate stuff.  You can copy and paste this file, update the info inside and rename from example.env to just .env

ENVs work like this:

Assign your EVs insode the .env file like so
    Username=example

And yopu reference them in php like this
```php
$username = env('Username','');
```

