timedatectl set-timezone Asia/Tokyo
localectl set-locale LANG=ja_JP.utf8
setenforce 0
sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config
yum -y groupinstall "Base" "Development tools" "Japanese Support"

# Apache2.4
yum -y install httpd

# PHP7.1
yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
yum -y install --enablerepo=remi-php71 php

# PHP拡張ライブラリ Laravel
yum -y install --enablerepo=remi-php71 php-pdo php-tokenizer php-openssl php-mbstring php-xml

# Composer
yum -y install --enablerepo=remi-php71 composer

# MariaDB uninstall
yum -y remove mariadb-libs

# MySQL5.7
yum -y localinstall https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm
yum -y install mysql-community-server mysql-community-devel

# Nodejs & yarn
wget https://dl.yarnpkg.com/rpm/yarn.repo -O /etc/yum.repos.d/yarn.repo
curl --silent --location https://rpm.nodesource.com/setup_6.x | bash -
yum -y install nodejs yarn

cp /etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf.org
cp /etc/php.ini /etc/php.ini.org
cp /etc/my.cnf /etc/my.cnf.org

\cp -f /vagrant/shell/config/etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf
\cp -f /vagrant/shell/config/etc/httpd/conf.d/laravel.conf /etc/httpd/conf.d/laravel.conf
\cp -f /vagrant/shell/config/etc/php.ini /etc/php.ini
\cp -f /vagrant/shell/config/etc/my.cnf /etc/my.cnf

systemctl start httpd
systemctl enable httpd
systemctl start mysqld
systemctl enable mysqld

cat << EOS >> /home/vagrant/.bashrc

PS1="[\u@\H \W]$ "

# ls ファイル一覧表示、容量サイズ表示
alias ll='ls -lh --time-style=long-iso'
# ls ファイル一覧表示、容量サイズ表示、隠しファイル表示
alias la='ls -alh  --time-style=long-iso'

# Laravel
alias test='vendor/bin/phpunit --colors=always'
alias art='php artisan'

# Git
alias gb='git branch'
alias gc='git checkout'
alias gcb='git checkout -b'
alias gs='git status'
alias gcm='git checkout master'
alias gpom='git pull origin master'
alias gmm='git merge master'

EOS
