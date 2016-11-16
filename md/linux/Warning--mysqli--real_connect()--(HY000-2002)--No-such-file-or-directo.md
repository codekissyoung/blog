#`Warning: mysqli::real_connect(): (HY000/2002): No such file or director`

首先确定是mysql_connect()和mysql_pconnect()的问题，故障现象就是函数返回空
而mysql_error()返回`No such file or directory`写个phpinfo页面，找到`mysql.default_socket、mysqli.default_socket、pdo_mysql.default_socket`


![WechatIMG14.jpeg](http://upload-images.jianshu.io/upload_images/196765-b5aca5778ca8a00f.jpeg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

登录mysql,执行 `status`命令
![WechatIMG15.jpeg](http://upload-images.jianshu.io/upload_images/196765-3d7cd206adb8fdaf.jpeg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

修改下 `sudo vim /etc/php.ini` 配置文件


![WechatIMG16.jpeg](http://upload-images.jianshu.io/upload_images/196765-9d32fa26d42fbbd8.jpeg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

重启下`sudo /etc/init.d/php-fpm  restart` 就好了
