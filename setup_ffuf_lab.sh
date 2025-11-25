#!/bin/bash

# FFUF LAB SETUP SCRIPT
# Cyber Twinkle

# Require root
if [ "$EUID" -ne 0 ]; then
    echo "Please run as root: sudo bash setup_ffuf_lab.sh"
    exit
fi

echo "[+] Updating system..."
apt update -y

echo "[+] Installing Apache & PHP..."
apt install -y apache2 php libapache2-mod-php unzip

echo "[+] Enabling important Apache modules..."
a2enmod rewrite
a2enmod headers

echo "[+] Preparing /var/www/html..."
mkdir -p /var/www/html
rm -rf /var/www/html/*
cp -r webroot/* /var/www/html/

echo "[+] Deploying virtual host directories..."
for d in vhosts/*/; do
    name=$(basename "$d")
    rm -rf "/var/www/$name"
    cp -r "$d" "/var/www/$name"
done

echo "[+] Deploying virtual host configs..."
cp vhosts/*.conf /etc/apache2/sites-available/

echo "[+] Fixing wildcard FFUF vhost..."
cat <<EOF >/etc/apache2/sites-available/wildcard.ffuf.conf
<VirtualHost *:80>
    ServerName ffuf.lab
    ServerAlias *.ffuf.lab
    DocumentRoot /var/www/wildcard.ffuf

    <Directory /var/www/wildcard.ffuf>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF

echo "[+] Disabling default Apache site..."
a2dissite 000-default.conf 2>/dev/null

echo "[+] Enabling FFUF vhosts..."
for f in /etc/apache2/sites-available/*.conf; do
    a2ensite "$(basename "$f")"
done

echo "[+] Adding hosts entries..."
add_host() {
    if ! grep -q "$1" /etc/hosts; then
        echo "$1" >> /etc/hosts
    fi
}

add_host "127.0.0.1 dev.local"
add_host "127.0.0.1 api.local"
add_host "127.0.0.1 test.local"
add_host "127.0.0.1 ffuf.lab"
add_host "127.0.0.1 internal.dev.local"
add_host "127.0.0.1 backup.dev.local"
add_host "127.0.0.1 debug.api.local"
add_host "127.0.0.1 wildcard.ffuf.lab"

echo "[+] Restarting Apache..."
systemctl restart apache2

echo ""
echo "==============================================="
echo "[+] FFUF Lab installation COMPLETE!"
echo "Visit:  http://localhost/"
echo "        http://dev.local"
echo "        http://api.local"
echo "        http://ffuf.lab"
echo "==============================================="
echo ""
