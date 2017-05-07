
## 作業ディレクトリを作成する

```
$ mkdir ~/projects/laravel_tutorial; cd $_
```

## GitHubでリポジトリを作成する。

`imamura-2ndwave/laravel_tutorial`

## 作業ディレクトリ内で次のコマンドを実行する。

```
echo "# laravel_tutorial" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/imamura-2ndwave/laravel_tutorial.git
git push -u origin master
```

## 仮想マシン

CentOS7のインストール〜起動

```
$ vagrant init centos/7
$ vagrant up
```

## 仮想マシンの構築手順を書く

```
$ mkdir shell
$ touch shell/install.sh
```

次の環境構築の手順は `install.sh` にあとでまとめる。

### 作業はrootユーザーで行う

```
$ sudo su -
```

### OSの設定など

```
# timedatectl set-timezone Asia/Tokyo
# localectl set-locale LANG=ja_JP.utf8
# setenforce 0
# sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config
# yum -y groupinstall "Base" "Development tools" "Japanese Support"
```

### Apacheのインストール

```
# yum -y install httpd
```

### PHP7.1のインストール

```
# yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
# yum -y install --enablerepo=remi-php71 php
```

### PHP拡張ライブラリのインストール(Laravel)

```
# yum -y install --enablerepo=remi-php71 php-pdo php-tokenizer php-openssl php-mbstring php-xml
```

### Composer

```
# yum -y install --enablerepo=remi-php71 composer
```

### MariaDBのアンインストール

```
# yum -y remove mariadb-libs
```

### MySQL5.7のインストール

```
# yum -y localinstall https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm
# yum -y install mysql-community-server mysql-community-devel
```

### Nodejs & yarn

```
# wget https://dl.yarnpkg.com/rpm/yarn.repo -O /etc/yum.repos.d/yarn.repo
# curl --silent --location https://rpm.nodesource.com/setup_6.x | bash -
# yum -y install nodejs yarn
```

### 設定ファイルのバックアップ

```
# cp /etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf.org
# cp /etc/php.ini /etc/php.ini.org
```

### php.iniの初期設定

変更点のみ

```
; エラーログ関連
error_reporting = E_ALL | E_STRICT
display_errors = On
log_errors = On
error_log = /var/log/php_error.log

; 文字コード関連
default_charset = "UTF-8"
mbstring.language = Japanese
mbstring.http_input = pass
mbstring.http_output = pass
mbstring.encoding_translation = Off
mbstring.detect_order = auto

; メモリ管理
memory_limit = 128M
post_max_size = 20M
upload_max_filesize = 20M

; セキュリティ関連
expose_php = Off

; 日付関連
date.timezone = "Asia/Tokyo"

; その他
short_open_tag = Off
register_argc_argv = On
max_execution_time = 60
```

### laravel.confの初期設定

`/etc/httpd/conf.d/laravel.conf`

```
EnableSendfile off

<VirtualHost *:80>
    DocumentRoot /var/www/laravel/public
    ServerName laravel.dev
    ServerAdmin info@example.com
    ErrorLog /var/log/httpd/laravel_error_log
    CustomLog /var/log/httpd/laravel_access_log combined
    CustomLog /var/log/httpd/laravel_deflate_log deflate

    <Directory /var/www/laravel/public>
        Require all granted
        AllowOverride All
    </Directory>
</VirtualHost>
```

`/var/www/laravel/public` ディレクトリは存在しないので、Laravelのインストール後にApacheを再起動する。

### Laravelのインストール

$ composer create-project --prefer-dist laravel/laravel laravel