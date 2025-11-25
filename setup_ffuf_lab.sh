#!/bin/bash

# FFUF LAB SETUP SCRIPT
# Cyber Twinkle

# Check root
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

echo "[+] Preparing /var/www/html directory..."
mkdir -p /var/www/html
rm -rf /var/www/html/*
cp -r webroot/* /var/www/html/

echo "[+] Deploying virtual host directories..."
for dir in vhosts/*/; do
    name=$(basename "$dir")
    rm -rf "/var/www/$name"
    cp -r "$dir" "/var/www/$name"
done

echo "[+] Deploying virtual host configs..."
cp vhosts/*.conf /etc/apache2/sites-available/

echo "[+] Disabling default Apache site..."
a2dissite 000-default.conf 2>/dev/null

echo "[+] Enabling all virtual host configs..."
for f in /etc/apache2/sites-available/*.conf; do
    a2ensite "$(basename "$f")"
done

echo "[+] Adding hosts entries (skipping duplicates)..."
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
echo "[+] FFUF Lab installation COMPLETE!"
echo "Open in browser: http://localhost/"
echo "Try: http://dev.local, http://api.local, http://ffuf.lab"
echo ""
