# 原则
- 优先选择该系统版本上的默认软件,比如`ubuntu 16.04`的默认PHP版本是7.0,那就不要去用7.1的版本,否则会带来很大的麻烦

# 查看系统版本和环境
```bash
lsb_release -a
cat /etc/issue
uname -a
```

# 中文支持
```
sudo apt-get install language-pack-zh-hans
sudo apt-get install zhcon
```

# 安装软件
```
sudo apt-get update 更新软件源
sudo apt-get upgrade　从软件源处更新软件
sudo apt-get autoremove 自动卸载系统不需要的软件
sudo apt-get install vim　安装vim编辑器
sudo update-alternatives --config editor 默认编辑设置为vim
sudo apt-get install tmux tumx用于保持工作现场
sudo apt-get install lnav 安装终端看访问日志的神器 lnav观看
sudo apt-get install openssh-server 安装ssh-server,可供远程登录
sudo apt-get install git 安装git,用于管理代码
sudo apt-get install unrar 安装rar解压工具, unrar x test.rar 解压到当前文件夹
sudo apt-get install zsh 安装zsh 配置oh-my-zsh
```


# Nginx 
```
service apache2 stop
apt-get remove apache2
apt-get install nginx
service nginx start
curl localhost # 验证下安装是否成功
```
`sudo path/to/nginx` 启动

`sudo nginx -s reload` 重启

`sudo　nginx -s stop` 停止

`curl localhost` 测试是否安装正确

# nginx 403 forbidden
* 缺少index.html或者index.PHP文件
* 目录权限:nginx的启动用户默认是nginx的,把web目录的权限改大，或者是把nginx的启动用户改成目录的所属用户，重起一下就能解决
[http://segmentfault.com/a/1190000003067828#articleHeader1](http://segmentfault.com/a/1190000003067828#articleHeader1) 
[http://macshuo.com/?p=547](http://macshuo.com/?p=547)  趣谈个人建站 lnmp 架构

# 使用apt-get安装 lnmp 架构
使用的是root用户
安装mysql
```
apt-get install mysql-server mysql-client
```


安装php-fpm
```
apt-get install php5-fpm
apt-get install php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl php-apc
```
配置文件 `vim  /etc/php5/fpm/php.ini `
```
cgi.fix_pathinfo=0
```
改变php-fpm监听 `vi /etc/php5/fpm/pool.d/www.conf`
```
;listen = /var/run/php5-fpm.sock 
listen = 127.0.0.1:9000
```
新建个测试文件 `vim /usr/share/nginx/html/info.php`
```
<?php phpinfo(); ?>
```
重新启动php5-fpm  `service php5-fpm reload`
重新启动nginx `service nginx reload`
错误处理 报错 `reload: Unknown instance`
```
sudo pkill php5-fpm; sudo service php5-fpm start
```

浏览器访问下 `localhost/info.php` 查看是否支持php以及相关模块

# 安装 Memcache 
sudo apt-get install memcached #安装php memcached 扩展
memcached -d -m 50 -p 11211 -u root #启动一个memcached服务
-d 是启动一个守护进程 
-m 指定使用多少兆的缓存空间；
-p 指定要监听的端口； 
-u 指定以哪个用户来运行
-l 是监听的服务器ip地址，默认为127.0.0.1  
-c是最大并发连接数，默认1024 
-P是保存pid文件 如/tmp/memcached.pid
使用telnet测试 memcached 服务
$ telnet localhost 11211 Trying 127.0.0.1...Connected to localhost.

# ubuntu 16.04 搭建Ubuntu(16.04) + Apache(2.4) + Mysql(5.7) + PHP(7.0)环境
## 搭建目标
```
cky@cky-pc:~/worksapce$ apache2 -v
Server version: Apache/2.4.18 (Ubuntu)
Server built: 2016-04-15T18:00:57
cky@cky-pc:~/worksapce$ mysql --version
mysql Ver 14.14 Distrib 5.7.12, for Linux (x86_64) using EditLine wrapper
PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
Copyright (c) 1997-2016 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2016 Zend Technologies
with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2016, by Zend Technologies
```
## 安装并配置apache2.4
```
sudo apt-get install apache2
```
```
sudo vim /etc/apache2/apache2.conf
    // 将 <Directory /var/www/>
    // 改成 <Directory "你的目录">
sudo vim /etc/apache2/sites-available/000-default.conf
    // 将 DocumentRoot /var/www/html
    // 改成 DocumentRoot "你的目录"
```
```
sudo /etc/init.d/apache2 restart
```
## 安装php7.0
```
sudo apt-get install php7.0
sudo apt-get install libapache2-mod-php7.0
```
安装更多的模块
```
sudo apt-get install php7.0[tab]
```
## 安装数据库
```
sudo apt-get install mysql-server mysql-client
sudo apt-get install php7.0-mysql
```
## 操作数据库
```
/etc/init.d/mysql start｜stop|restart
```


# 开启 Mcrypt 模块
sudo php5enmod mcrypt
sudo service apache2 restart

# apache 相关的
http://blog.csdn.net/u013178760/article/details/45393183    Apache 2.4 Rewrite 模块
http://blog.csdn.net/u013178760/article/details/48436777    Apache2 虚拟主机配置

# 安装apache
```
sudo apt-get install apache2
```
# 开启和关闭模块
```
sudo a2enmod rewrite #启用rewrite模块 
sudo a2dismod rewrite #禁用rewrite模块
```
# 开启和关闭站点
```
sudo a2ensite sitename ＃启用站点 
sudo a2dissite sitename ＃停用站点
```
# 允许使用.htaccess
```
AllowOverride None 改为 AllowOverride  All
```
# 重启|开启｜关闭apache 
```
sudo service apache2 restart|start|stop             重启|开启｜关闭apache 
sudo  /etc/init.d/apache2 restart|start|stop     　　重启｜开启｜关闭apache
```

## url重写
```
http://www.example.com/USA/California/San_Diego  
“/USA/California/San_Diego” 是能够Rewrite的字符串！
重写：就是实现URL的跳转和隐藏真实地址，基于Perl语言的正则表达式规范。平时帮助我们实现拟静态，拟目录，域名跳转，防止盗链等
```
## .htaccess
```
RewriteEnine on
RewriteRule  ^/t_(.*).html$  /test.php?id = $1#当访问任何以t_开头，以.html结尾的文件时，将$1用与(.*)匹配的字符替换后，访问相应的test.php页面
RewriteRule ^/test([0-9]*).html$ /test.php?id=$1RewriteRule ^/new([0-9]*)/$ /new.php?id=$1 [R]#当我们访问的地址不是以www.163.com开头的，那么执行下一条规则
RewriteCond %{HTTP_HOST} !^www.163.com [NC]RewriteRule ^/(.*) http://www.163.com/ [L]
```

## Apache Rewrite规则修正符
```
1) R 强制外部重定向
2) F 禁用URL,返回403HTTP状态码。
3) G 强制URL为GONE，返回410HTTP状态码。
4) P 强制使用代理转发。
5) L 表明当前规则是最后一条规则，停止分析以后规则的重写。
6) N 重新从第一条规则开始运行重写过程。
7) C 与下一条规则关联 如果规则匹配则正常处理，以下修正符无效
8) T=MIME-type(force MIME type) 强制MIME类型
9) NS 只用于不是内部子请求
10) NC 不区分大小写
11) QSA 追加请求字符串
12) NE 不在输出转义特殊字符 \%3d$1 等价于 =$1
```

## 核心模块
```
core_module,so_module,http_module,mpm
```
## 全局配置指令

```
#表示apache2这个软件安装的目录
ServerRoot  "/usr/local/apache2"

#监听端口命令 Listen  ip：portListen  80

#加载动态模块，
LoadModule  模块名   模块路径
LoadModule  php5_module  modules/libphp5.so

#是否加载某个模块容器
<IfModule ></IfMoudle>

#设置先读取 index.php 文件
<IfModule dir_module>
  DirectoryIndex index.php index.html
</IfModule>

#留下管理员邮箱
ServerAdmin 1162097842@qq.com

#用于多个域名访问同一个ip时，辨别它们访问的主机
ServerName pms.com

#设置主机所有文档的根目录
DocumentRoot "/var/www/html"
# 默认目录访问的文件
DirectoryIndex index.html index.htm index.php

添加默认字符集  AddDefaultCharset GB2312
监听ip是192.168.1.1的地址和端口为80创建虚拟目录
Alias /down    "/sofТWare /download"   创建名为down的虚拟目录，它对应的物理路径是：/sofТWare /download
设置目录权限<Directory "目录路径">    此次写设置目录权限的语句        
Options FollowSymLinks  允许符号链接 Options Indexes         允许用户浏览网页目录，（不安全的设置，建议删除）      
AllowOverride None      不允许 .htaccess 重写这个目录，改为 All 则能重写
</Directory>
```

# Set Search Domain
在Ubuntu设置IPv4时，
ip 地址 : 10.10.10.19
子网掩码 : 24
网关: 10.10.10.1
DNS服务器:119.29.29.29,114.114.114.114
搜索域:lingyunstrong.com
```
cky@cky-pc:~$ ping a
PING a.lingyunstrong.com (183.16.2.95) 56(84) bytes of data.
64 bytes from 183.16.2.95: icmp_seq=1 ttl=64 time=0.595 ms
64 bytes from 183.16.2.95: icmp_seq=8 ttl=64 time=0.655 ms
^C
--- a.lingyunstrong.com ping statistics ---
8 packets transmitted, 8 received, 0% packet loss, time 6997ms
rtt min/avg/max/mdev = 0.595/0.657/0.683/0.036 ms
cky@cky-pc:~$
cky@cky-pc:~$ ping cky
PING cky.lingyunstrong.com (10.10.10.19) 56(84) bytes of data.
64 bytes from 10.10.10.19: icmp_seq=1 ttl=64 time=0.026 ms
64 bytes from 10.10.10.19: icmp_seq=2 ttl=64 time=0.025 ms
^C
--- cky.lingyunstrong.com ping statistics ---
2 packets transmitted, 2 received, 0% packet loss, time 1001ms
rtt min/avg/max/mdev = 0.025/0.025/0.026/0.005 ms
cky@cky-pc:~$ ping cky.linyunstrong.com
PING cky.linyunstrong.com.lingyunstrong.com (183.16.2.95) 56(84) bytes of data.
64 bytes from 183.16.2.95: icmp_seq=1 ttl=64 time=0.594 ms
64 bytes from 183.16.2.95: icmp_seq=4 ttl=64 time=0.648 ms
^C
--- cky.linyunstrong.com.lingyunstrong.com ping statistics ---
4 packets transmitted, 4 received, 0% packet loss, time 3002ms
rtt min/avg/max/mdev = 0.594/0.629/0.662/0.036 ms
cky@cky-pc:~$ ping a
PING a.lingyunstrong.com (183.16.2.95) 56(84) bytes of data.
64 bytes from 183.16.2.95: icmp_seq=1 ttl=64 time=0.587 ms
64 bytes from 183.16.2.95: icmp_seq=3 ttl=64 time=0.641 ms
^C
--- a.lingyunstrong.com ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 2000ms
rtt min/avg/max/mdev = 0.587/0.628/0.658/0.041 ms
cky@cky-pc:~$ ping baidu.com
PING baidu.com (180.149.132.47) 56(84) bytes of data.
64 bytes from 180.149.132.47: icmp_seq=1 ttl=54 time=36.8 ms
64 bytes from 180.149.132.47: icmp_seq=4 ttl=54 time=39.6 ms
^C
--- baidu.com ping statistics ---
4 packets transmitted, 4 received, 0% packet loss, time 3003ms
rtt min/avg/max/mdev = 36.188/37.903/39.637/1.439 ms
cky@cky-pc:~$ ping sina.com
PING sina.com (66.102.251.33) 56(84) bytes of data.
^C
--- sina.com ping statistics ---
2 packets transmitted, 0 received, 100% packet loss, time 1007ms
```

# 安装monaco字体
进入github下载这个字体，github地址是`https://github.com/cstrap/monaco-font`
`sudo ./install-font-ubuntu.sh https://github.com/todylu/monaco.ttf/blob/master/monaco.ttf?raw=true` 这个命令


# 追踪路由
```
➜  blog git:(master)  sudo traceroute m.dev.yunchongba.com
traceroute to m.dev.yunchongba.com (120.25.71.101), 30 hops max, 60 byte packets
 1  10.10.10.1 (10.10.10.1)  0.587 ms  0.584 ms  0.576 ms
 2  183.15.192.1 (183.15.192.1)  6.095 ms  6.930 ms  6.930 ms
 3  113.106.44.53 (113.106.44.53)  6.070 ms  7.084 ms  7.552 ms
 4  119.145.47.185 (119.145.47.185)  7.049 ms  7.318 ms  7.317 ms
 5  183.56.65.6 (183.56.65.6)  12.428 ms 183.56.65.14 (183.56.65.14)  12.696 ms 183.56.65.18 (183.56.65.18)  11.576 ms
 6  202.97.85.114 (202.97.85.114)  27.501 ms * *
 7  220.191.200.14 (220.191.200.14)  32.215 ms 220.191.200.18 (220.191.200.18)  28.028 ms *
 8  115.236.101.221 (115.236.101.221)  32.115 ms 115.238.21.117 (115.238.21.117)  32.036 ms 115.236.101.213 (115.236.101.213)  34.018 ms
 9  42.120.247.109 (42.120.247.109)  30.852 ms 42.120.247.53 (42.120.247.53)  33.999 ms 42.120.247.57 (42.120.247.57)  30.814 ms
10  42.120.239.138 (42.120.239.138)  58.777 ms  58.821 ms 42.120.242.81 (42.120.242.81)  58.187 ms
11  42.120.239.134 (42.120.239.134)  56.089 ms 42.120.239.158 (42.120.239.158)  52.129 ms 42.120.239.146 (42.120.239.146)  57.078 ms
12  42.120.253.6 (42.120.253.6)  50.913 ms  51.081 ms 42.120.253.2 (42.120.253.2)  54.589 ms
13  42.120.253.6 (42.120.253.6)  50.205 ms * *
```
# 截图
自带的截图软件,使用 `shift + printscreen` 截图
