Program Overview
-------------------------
Queries metadata address on AWS EC2 instances to help see what machine you hit behind an ELB


Installation of EC2
-------------------------
Paste into bootstrapping

#!/bin/sh
#
# Reconfigure ssh keys
/bin/rm -v /etc/ssh/ssh_host_*
dpkg-reconfigure openssh-server
#
# Install applications
apt-get install -y apache2 php5 awscli git
#
cd /
rm -f /var/www/html/index.*
#
# GIT  code
cd /var/www/html && git clone http://github.com/alphamusk/aws-metadata-php-page aws-metadata-php-page
#
# Cron job to git source every 30 mins
# m h  dom mon dow   command
job="*/30 * * * *  cd /var/www/html/aws-metadata-php-page && git pull http://github.com/alphamusk/aws-metadata-php-page.git > /dev/null 2>&1"
(crontab -u ${USER} -l; echo "${job}" ) | crontab -u ${USER} -




