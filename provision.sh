#!/bin/sh

yum install -y  httpd php squid

# startup apache
chkconfig httpd on
echo "EnableSendfile off" >> /etc/httpd/conf/httpd.conf
sed -i.bak -e "s/AllowOverride None/AllowOverride All/" /etc/httpd/conf/httpd.conf
/sbin/service httpd start

# startup squid
chkconfig squid on
/sbin/service squid start

# extract cakephp files.
wget -q -O - https://github.com/cakephp/cakephp/archive/2.5.7.tar.gz | tar zxf - -C /var/www/html --strip-components=1
