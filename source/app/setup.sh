#ServerUpgrade
yum install epel-release
rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
yum-config-manager --enable remi-php73	
yum --enablerepo=remi-php73 install php-xml php-soap php-xmlrpc php-mbstring php-json php-gd php-mcrypt
yum install unzip
php -v
chmod -R gu+w storage && chmod -R guo+w storage && chmod 777 -R * && chown apache:apache -R *
cp -a httpd.conf /etc/httpd/conf/httpd.conf

