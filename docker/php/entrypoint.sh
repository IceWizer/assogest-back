#!/bin/bash

if [ "$1" != "" ]; then
	exec "$@";
	echo "Hey, I'm here!";
	exit 0;
fi

# Migration database
php bin/console doctrine:migrations:migrate --no-interaction

# Clear cache
php bin/console cache:clear

# Update lexik/jwt-authentication-bundle
php bin/console lexik:jwt:generate-keypair


# Start PHP-FPM
php-fpm