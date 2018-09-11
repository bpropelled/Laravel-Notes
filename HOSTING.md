# Hosting

## Shared Hosting a LAravel Site
It's quite easy really, i don't have a vps either and although i might not be able to use artisan commands through ssh, heres how i do it.

1. for step one, i assume you have a localhost running, something like xampp with mysql, and that you have migrated and seeded your db
2. move the public folder outside of your laravel folder and rename it to public_html
3. inside the public_html folder, open index.php and add ../laravel to the two includes
4. upload the laravel folder to your domain's root (so it's outside of the public_html folder)
5. upload the contents of your public_html to the domain public_html
6. change your .env file to your domain settings
7. make an export of your localhost mysql tables and import them on your domain's myql
   
All done, site should be running!



## Laravel hosting on a subdomain