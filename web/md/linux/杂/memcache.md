# memcache 官网下载最新版本的源代码
```bash
wget http://www.memcached.org/files/memcached-1.4.30.tar.gz
```

# 正常解压编译
```bash
tar -zxvf memcached-1.4.30.tar.gz
cd memcached-1.4.30
sudo ./configure   # 这里有个报错 ，解决方案写在下面了
sudo make
sudo make install
```

# 安装memcached 客户端
```bash
wget
https://launchpad.net/libmemcached/1.0/1.0.18/+download/libmemcached-1.0.18.tar.gz
```
编译
```bash
sudo ./configure  --prefix=/usr/local/libmemcached
```

# 安装php7的 memcached 拓展
```bash
wget https://github.com/websupport-sk/pecl-memcache/archive/php7.zip
```

解压后需要在源代码目录运行`phpize`(php拓展安装工具)
```bash
/usr/local/php/bin/phpize
```

正常编译:
```bash
sudo ./configure  --with-php-config=/usr/local/php/bin/php-config
sudo make
sudo make install
```

修改`php.ini`文件,添加上该拓展
```bash
extension_dir = "/usr/local/php/lib/php/extensions/no-debug-non-zts-20151012"
extension = "memcache.so"
```
重启下php-fpm
```bash
sudo /etc/init.d/php-fpm  restart
```

# 启动 Memcache
启动例子：`memcached -u root -d`
启动参数说明：
```bash
-d 选项是启动一个守护进程。
-m 是分配给Memcache使用的内存数量，单位是MB，默认64MB。
-u 是运行Memcache的用户，如果当前为root 的话，需要使用此参数指定用户
-p <num>是设置Memcache的TCP监听的端口，最好是1024以上的端口。
-c 选项是最大运行的并发连接数，默认是1024。
-P <file> 是设置保存Memcache的pid文件
```

# 报错处理
```bash
checking for libevent directory... configure: error: libevent is required. You can get it from
http://www.monkey.org/~provos/libevent/
If its already installed, specify its path using --with-libevent=/dir/
```

遇到这种问题,有两种情况,解决方案
意思是libevent不存在，可以从上面网址下载，如果存在的话，编译时可以加上libevent的路径；，

- 没有安装libevent,查看libevent是否安装，如下命令：`ls -a /usr/lib |grep libevent`,或者 libevent 独立安装的 , configure 需要加上它的路径`--with-libevent=/dir/`

- 已经安装了libevent，因为libevent 这个包是系统默认安装的，没有安装相应的开发所用的头文件。可以yum安装如下：`yum install libevent-devel`安装后再编译就没有问题了














