# welcom
teste de compétence welcom  
Environement
PHP >=7.2.5
PDO-SQLite PHP extension avtive;
Installation
Composer install
Utilisation
cd welcom
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
php symfony server:start
