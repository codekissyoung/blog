# 普通位置
`/bin    /sbin    /usr/bin    /usr/sbin    /usr/local/bin ` 存放命令的文件

`/boot`   存放内核和系统启动所需文件

`/opt`    安装的大应用程序文件,第三方软件的安装目录,是一个可选的软件安装路径,现在已经用的不多了

`/tmp`    临时文件

`/lost+found` 系统修复过程中恢复的文件

`/root`   超级用户主目录

`/root/.bash_profile `   root用户配置环境变量的文件

`/home`  普通用户目录

`/home/username/.bash_profile`    username 用户配置环境变量的文件

`/misc`  杂项目录,一般为空

`/SElinux` 跟selinux(安全linux)相关的内容

# /dev    设备文件目录

`/dev/cdrom`        光驱设备

`/dev/fd0 `         软驱

# `/etc` 配置文件
`/etc/lilo.conf `   启动引导程序文件

`/etc/grub.conf`     多系统引导时，配置文件

`/etc/inittab `   控制启动模式（图形/文本登录）

`/etc/fstab `   文件系统配置

`/etc/profile`    增加环境变量等的配置文件 如PATH 如配置javaEE 开发环境

`/etc/ftp*`    ftp 的配置文件

`/etc/ssh*`    ssh的配置文件

`/etc/resolv.conf`    dns域名服务器的配置文件

`/etc/passwd`    系统能识别的用户清单，纯文本显示加密了的口令，普通用户可读

`/etc/shadow`    超级用户才能读，用于保护加密口令的安全，隐藏口令

`/etc/group`    放置所有组名的地方

`/etc/sysconfig/network-scripts/ifcfg-etho`    ip地址的配置文件

`/etc/hosts`    类似于window  host 文件的

# `/lib`    共享库
`/lib/modules/2.4.20-8/kernel/drivers`    驱动模块

# `/usr` 用户共享的只读文件目录
`/usr/lib/`        应用程序使用的库文件如 mysql的api

`/usr/sbin`        系统管理的命令

`/usr/bin`        几乎所有的命令程序

`/usr/include`   c语言的头文件

`/usr/doc`    　　/usr/share/doc    帮助文档

`/usr/share`    　共享文件和数据

`/usr/src/linux-2.4.20-8/`    linux 源代码

`/usr/local`      本地安装的软件

# /mnt    装载目录

# /var 变量文件
`/var/lib`    　系统运行时随时改变的文件

`/usr/local`　　程序的可变数据

`/var/log`   　日志文件

`/var/spool`    邮件，新闻等队列的脱机目录

`/var/tmp`   　临时文件

`/var/run`      进程运行时使用的文件

`/var/lock`     锁(对于可能发生资源抢夺的文件都应该加锁)

`/var/account`  进程的记账日志

`/var/cache`    缓存目录

# 临时文件目录
`/srv` 服务运行时的中间数据文件

`/temp`　临时文件,公共场所

# 伪文件系统
只有系统运行时才会有文件的目录,系统调优的时候用的比较多

`/proc` 内核信息

`/sys`  跟硬件关联比较多
