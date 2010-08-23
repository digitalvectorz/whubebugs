#!/bin/bash

echo -e "\n\n"
echo "OK. It's \"installed\"."
echo "You [1mneed[0m to modify your apache config ( the <Directory> )"
echo "to allow us to use .htaccess files."
echo "One sample looks like:"
echo ""
echo "This is in \"/etc/apache/sites-enabled/000-default\" "
echo "by default"
echo ""
echo "        <Directory /var/www/>"
echo "                Options Indexes FollowSymLinks MultiViews"
echo "                AllowOverride All"
echo "                Order allow,deny"
echo "                allow from all"
echo "        </Directory>"
echo ""
echo "Thanks a bunch for using Whube!"
echo "  -- Paul Tagliamonte & The Whube Team"
echo ""
