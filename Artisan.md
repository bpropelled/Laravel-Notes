# Artisan Notes

Artisan is Laravels main development tool.  Artisan can help easily generate **Controllers, Models, Migrations, Seeds, Tests** and many others based on simple templates so we don't have to start from scratch.

Artisan is also helpful by having a built in server to deploy a local laravel application, run database migrations, clear application cache.
## Run the Web Server using Artisan
    ```cmd 
    php artisan serve 
    ```

## Put the application in **Maintenance Mode**.  This is useful when making changes or hot fixes to an application in production.  Simply take it down to make the changes
    ```cmd 
    php artisan down 
    ```

## Take the application out of maintenance mode 
    ```cmd 
    php artisan up 
    ```

## Clearing the Application Cache 
    When making changes to the applciation, some times things can get cached and not shown in the recent changes you have made to the application 
    ```cmd 
php artisan cache:clear 
```



