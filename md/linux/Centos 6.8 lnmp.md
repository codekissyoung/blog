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
# 安装mysql
```
sudo yum install mysql.x86_64 mysql-server.x86_64 mysql-devel.x86_64
```
# 安装php
```
sudo yum install php lighttpd-fastcgi.x86_64 php-cli.x86_64 php-mysql.x86_64 php-gd.x86_64 php-imap.x86_64 php-ldap.x86_64 php-odbc.x86_64 php-pear php-xml php-xmlrpc.x86_64 php-mbstring.x86_64 php-mcrypt.x86_64 php-snmp.x86_64 php-soap.x86_64 php-tidy.x86_64 php-common.x86_64 php-devel.x86_64 php-fpm.x86_64
```

# 配置lnmp
安装完后的软件版本
```
nginx version: nginx/1.10.1

mysql  Ver 14.14 Distrib 5.1.73, for redhat-linux-gnu (x86_64) using readline 5.1

PHP 5.3.3 (cli) (built: Aug 11 2016 20:33:53)
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
