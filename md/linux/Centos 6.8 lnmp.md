> 修改日期:16.11.10

# 新建用户
```
[root@iZ252e1zy6zZ ~]# useradd cky
[root@iZ252e1zy6zZ ~]# passwd cky
[root@iZ252e1zy6zZ ~]# visudo
```
编辑
```
## Allow root to run any commands anywhere
root    ALL=(ALL)       ALL
cky     ALL=(ALL)       ALL ## 新增
```

# 更新和安装软件
```
[root@iZ252e1zy6zZ ~]# yum update
[root@iZ252e1zy6zZ ~]# cal
[root@iZ252e1zy6zZ ~]# date # 查看时间是否正确
[root@iZ252e1zy6zZ ~]# yum install tmux
```

# 切换成普通用户
```
[root@iZ252e1zy6zZ ~]# su cky

[cky@iZ252e1zy6zZ ~]$ tmux new-session -s console # 新建tmux窗口
```

# 安装zsh 并配置 `oh my zsh`
```
[cky@iZ252e1zy6zZ ~]$ sudo yum install zsh

[cky@iZ252e1zy6zZ ~]$ sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
```

# 设置下客户端ssh 无密码登录
客户端将自己的`id_rsa.pub`传到服务器上去
```
scp .ssh/id_rsa.pub cky@101.200.144.41:~/
```
服务器端
```
cat id_rsa.pub >> .ssh/authorized_keys
```

# 安装nginx
安装默认的nginx和它的所有模块
```
sudo yum install nginx.x86_64 nginx-all-modules.noarch
```

# 安装 MariaDB
Here is your custom MariaDB YUM repository entry for CentOS. Copy and paste it into a file under /etc/yum.repos.d/ (we suggest naming the file MariaDB.repo or something similar). See "Installing MariaDB with yum" for detailed information.
```
# MariaDB 10.1 CentOS repository list - created 2016-11-15 06:33 UTC
# http://downloads.mariadb.org/mariadb/repositories/
[mariadb]
name = MariaDB
baseurl = http://yum.mariadb.org/10.1/centos6-amd64
gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB
gpgcheck=1
```


# 安装php 5.6
## 配置yum源
追加CentOS 6.5的epel及remi源
```
rpm -Uvh http://ftp.iij.ad.jp/pub/linux/fedora/epel/6/x86_64/epel-release-6-8.noarch.rpm
rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
```
使用yum list命令查看可安装的包(Packege)
```
yum list --enablerepo=remi --enablerepo=remi-php56 | grep php
```
安装php 5.6
```
yum install --enablerepo=remi --enablerepo=remi-php56 php php-opcache php-devel php-mbstring php-mcrypt php-mysqlnd php-phpunit-PHPUnit php-pecl-xdebug php-pecl-xhprof php-fpm
```
查看版本
```
➜  ~ php --version
PHP 5.6.28 (cli) (built: Nov  9 2016 07:23:55)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies
    with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2016, by Zend Technologies
    with Xdebug v2.4.1, Copyright (c) 2002-2016, by Derick Rethans

```

# 配置lnmp
安装完后的软件版本
```
nginx version: nginx/1.10.1

mysql  Ver 14.14 Distrib 5.1.73, for redhat-linux-gnu (x86_64) using readline 5.1

PHP 5.6.28 (cli) (built: Nov  9 2016 07:23:55)
```
nginx 报错
```
nginx: [emerg] socket() [::]:80 failed (97: Address family not supported by protocol)
```
解决方法:
`vim /etc/nginx/conf.d/default.conf` 注释掉下句
```
#listen       [::]:80 default_server;
```
准备 nginx.conf 文件
```
mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.bak
cp /etc/nginx/nginx.conf.default /etc/nginx/nginx.conf
```
`vim /etc/nginx/nginx.conf`
```
# 加入index.php
location / {
            root   html;
            index  index.php index.html index.htm;
        }

# 以tcp方式将nginx和php通信
location ~ \.php$ {
    root /usr/share/nginx/html;
    fastcgi_pass 127.0.0.1:9000;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME /usr/share/nginx/html$fastcgi_script_name;
    include fastcgi_params;
}
```
`vim /etc/php.ini` 关闭下面选项
[Nginx + PHP CGI的一个可能的安全漏洞](http://www.laruence.com/2010/05/20/1495.html)
```
cgi.fix_pathinfo = 0
```
重启nginx php-fpm
```
service nginx restart
service php-fpm restart
```
在目录下建立info.php ，里面用 `<?php phpinfo();` 测试下解析是否成功
