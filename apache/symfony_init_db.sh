#!/bin/bash
cd /var/www/html/jeu-set-et-match
composer install -o --classmap-authoritative
USER_TABLE_EXISTS=`php /var/www/php.d/user_table_exists.php`
if [ "$USER_TABLE_EXISTS" != "true" ] ; then
    php bin/console doctrine:database:drop --force --no-interaction --if-exists
    php bin/console doctrine:database:create --no-interaction
    php bin/console doctrine:migrations:migrate --no-interaction
    php bin/console doctrine:fixtures:load --no-interaction
fi