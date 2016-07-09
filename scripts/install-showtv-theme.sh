#!/bin/sh

# Install ShowTV theme

cd web/app/themes/showtv # Change directory to the themes folder
npm install # Install node modules
composer install # Installing server-side libraries
# npm install -g gulp bower # Install gulp and bower
bower install # Install dependencies
gulp # Run gulp commands
gulp --production # Build assets for production
cd - # Go back the previous directory

echo "You're now ready to use the ShowTV.com Wordpress app!"