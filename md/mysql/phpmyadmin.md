# phpMyAdmin 教程

## config.inc.php 配置

- 把`config.inc.php.sample`改为`config.inc.php`,然后修改下列选项

```php
$cfg['AllowArbitraryServer'] = true; // 允许在界面上 选择服务器
$cfg['Servers'][$i]['host'] = '10.10.61.57';
$cfg['blowfish_secret'] = 'abcdefghijklmnopqrstuvwxyz111111';
```

## 允许 MySQL 远程连接

- 默认情况下，mysql 只允许本地登录，如果要开启远程连接，则需要修改 `/etc/mysql/my.conf` 文件

```mysql
bind-address = 127.0.0.1 修改为
bind-address = 0.0.0.0
```

- 为需要远程登录的用户赋予权限

```sql

1. 新建用户远程连接mysql数据库
允许任何ip地址的电脑用 admin 和 123456 来访问这个 mysql server,注意admin账户不一定要存在。
mysql> grant all on *.* to admin@'%' identified by '123456' with grant option;
mysql> flush privileges;

2. 或者支持root用户允许远程连接mysql数据库
mysql> grant all privileges on *.* to 'root'@'%' identified by '123456' with grant option;
mysql> flush privileges;
```

- 查看系统用户

```sql
mysql> use mysql;
Database changed

mysql> select user,host from user;
+------------------+--------------+
| user             | host         |
+------------------+--------------+
| root             | %            |
| root             | 127.0.0.1    |
| root             | ::1          |
| root             | iz252e1zy6zz |
| debian-sys-maint | localhost    |
+------------------+--------------+
```

- 重启Mysql服务器, `sudo service mysql restart`