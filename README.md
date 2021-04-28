Tailwind CSS:

run: composer require laravel-frontend-presets/tailwindcss --dev
run: php artisan ui tailwindcss --auth
run:npm install && npm run dev

if user interface not work use!

npm install laravel-mix@latest --save-dev

Then you need to make a db change in the .env file and create A db is your phpmyadmin DB
after that do php artisan migrate 
then php artisan serve and it should work!


To get a pusher Key for the app you need to go to :

https://pusher.com/ 

And register and set up a pusher key and implement it inside .env file there is a good step by step form on the homepage.
