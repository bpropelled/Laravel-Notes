# Install Laravel

You have two options

```cmd
laravel new appName
```

or latest dev version

```cmd
laravel new appName  -dev
```
or using composer

```cmd
composer create-project --prefer-dist laravel/laravel appName
```

## Requiring package
```cmd

composer require packageName

```

## Generate an App Key
App Key is used for all encrypted data, like sessions.

.env is the good place for it.

```
php artisan key:generate
```

## Installing a database

Create a MySQL Database
```cmd
mysql user pass
```

## Application Key
### Generate an application key to encrypt sensitive app info, the key lives in the .env file for configing your app

The next thing you should do after installing Laravel is set your application key to a random string. If you installed Laravel via Composer or the Laravel installer, this key has already been set for you by the 

    php artisan key:generate command.

Typically, this string should be 32 characters long. The key can be set in the .env environment file. If you have not renamed the .env.example file to .env, you should do that now. If the application key is not set, your user sessions and other encrypted data will not be secure!

## Configuration
**Public Directory**
After installing Laravel, you should configure your web server's document / web root to be the  public directory. The index.php in this directory serves as the front controller for all HTTP requests entering your application.

**Configuration Files**
All of the configuration files for the Laravel framework are stored in the config directory. Each option is documented, so feel free to look through the files and get familiar with the options available to you.

**Directory Permissions**
After installing Laravel, you may need to configure some permissions. Directories within the  storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run. If you are using the Homestead virtual machine, these permissions should already be set.