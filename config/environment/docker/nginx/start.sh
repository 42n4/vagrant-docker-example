#!/bin/sh

sed -i "s@<FPM_HOST>@${PHPFPM_PORT_9000_TCP_ADDR}@" /etc/nginx/sites-enabled/default
sed -i "s@<FPM_PORT>@${PHPFPM_PORT_9000_TCP_PORT}@" /etc/nginx/sites-enabled/default

/usr/sbin/nginx
