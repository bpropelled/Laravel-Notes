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