composer i
composer dump-autoload
php artisan cache:clear
php artisan config:clear
php artisan route:cache
php artisan migrate