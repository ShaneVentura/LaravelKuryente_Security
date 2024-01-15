Copying this repository requires the following steps:
1. Clone the repository
2. Install the dependencies
    npm install
    composer install
3. Cache the configuration
    php artisan config:cache
4. Run the migrations (and seed the database)
    php artisan migrate
    need manually seed the database table rate and meter
    php artisan db:seed --class=ElectricUsageTableSeeder
    npm run build
5. Run the application
    php artisan serve
    npm run dev
    php artisan websockets:serve
6. Open the application in your browser
    => http://localhost:8000
