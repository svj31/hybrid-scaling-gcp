#!/bin/bash

# Update packages
apt update -y

# Install required packages
apt install -y apache2 php libapache2-mod-php git

# Enable and start Apache
systemctl enable apache2
systemctl start apache2

# Remove default page
rm -f /var/www/html/index.html

# Ensure Apache prioritizes PHP
sed -i 's/DirectoryIndex .*/DirectoryIndex index.php index.html/' /etc/apache2/mods-enabled/dir.conf

# Clone your GitHub repo
cd /var/www/html
git clone https://github.com/svj31/hybrid-scaling-gcp.git .

# Set permissions
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

# Restart Apache
systemctl restart apache2