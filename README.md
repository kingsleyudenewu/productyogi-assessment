# Product Yogi Assessment
A simple blog to enable users create post and comments.


<p>
  <blockquote style="color:red">
    **Please follow the steps below to setup the application on your system** 
  </blockquote>
</p>  

## Required Versions
-PHP 8.1

## Installation Steps

- Clone project
- Run ```composer install``` for the main project
- Rename .env.example to .env
- Create you database and set dbname, username and password on the new .env file
- Generate your laravel key : ```php artisan key:generate```
- Run ```php artisan migrate```
- Run ```php artisan db:seed``` to generate dummy data for user
- Run ```npm install``` to install the frontend dependencies like alpinejs and tailwindcss
- Run ```npm run dev``` to compile the assets
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
