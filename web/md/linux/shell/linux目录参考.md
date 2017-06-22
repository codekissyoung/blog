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


/dev/null
================================================================================
- /dev/null，或称空设备，是一个特殊的设备文件，它丢弃一切写入其中的数据（但报告写入操作成功），读取它则会立即得到一个EOF。通常被用于丢弃不需要的输出流

```bash
cat file 2>/dev/null # 将stderr重定向到 /dev/null ，这样就不会输出到控制台了
cat /dev/null > /var/log/file # 将file清空　，而又不删除它

if [ -f ~/.netscape/cookies ];then    # 如果存在则删除，删除后才可以添加软链接  
    rm -f ~/.netscape/cookies
fi    
ln -s /dev/null ~/.netscape/cookies  # 建立到/dev/null的软链接，这时所有该存到文件的输入都被丢入/dev/null了
```

/dev/zero
================================================================================
- 是一个特殊的文件，当你读它的时候，它会提供无限的空字符(NULL, ASCII NUL, 0x00)。
- 典型用法是用它提供的字符流来覆盖信息
- 另一个常见用法是产生一个特定大小的空白文件
- ELF二进制文件利用了/dev/zero

```bash
dd if=/dev/zero of=/dev/sdb bs=4M # 把/dev/sdb 清零
```


```bash
# 创建一个临时交换空间(类似于swap分区)
# 创建一个交换文件，参数为创建的块数量（不带参数则为默认），一块为1024B（1K）    
    
ROOT_UID=0         # Root 用户的 $UID 是 0.    
E_WRONG_USER=65    # 不是 root?    
    
FILE=/swap    
BLOCKSIZE=1024    
MINBLOCKS=40    
SUCCESS=0    
    
# 这个脚本必须用root来运行,如果不是root作出提示并退出    
if [ "$UID" -ne "$ROOT_UID" ]    
then    
  echo; echo "You must be root to run this script."; echo    
  exit $E_WRONG_USER    
fi     
      
    
blocks=${1:-$MINBLOCKS}          # 如果命令行没有指定，则设置为默认的40块.    
# 上面这句等同如：
# --------------------------------------------------
# if [ -n "$1" ]
# then
#   blocks=$1
# else
#   blocks=$MINBLOCKS
# fi
# --------------------------------------------------
if [ "$blocks" -lt $MINBLOCKS ]
then
  blocks=$MINBLOCKS              # 最少要有 40 个块长，如果带入参数比40小，将块数仍设置成40    
fi
echo "Creating swap file of size $blocks blocks (KB)."    
dd if=/dev/zero of=$FILE bs=$BLOCKSIZE count=$blocks # 把零写入文件.    
    
mkswap $FILE $blocks             # 将此文件建为交换文件（或称交换分区）.    
swapon $FILE                     # 激活交换文件.    
    
echo "Swap file created and activated."    
exit $SUCCESS
```

```bash
#!/bin/bash    
# ramdisk.sh    
# 为特定的目的而用零去填充一个指定大小的文件，如挂载一个文件系统到环回设备 （loopback device） 或"安全地" 删除一个文件。
# "ramdisk"是系统RAM内存的一段，它可以被当成是一个文件系统来操作.    
# 优点：存取速度非常快 (包括读和写).    
# 缺点: 易失性, 当计算机重启或关机时会丢失数据.    
# 会减少系统可用的RAM.    
# 那么ramdisk有什么作用呢?    
# 保存一个较大的数据集在ramdisk, 比如一张表或字典,这样可以加速数据查询, 因为在内存里查找比在磁盘里查找快得多.    
    
E_NON_ROOT_USER=70             # 必须用root来运行.    
ROOTUSER_NAME=root    
    
MOUNTPT=/mnt/ramdisk    
SIZE=2000                      # 2K 个块 (可以合适的做修改)    
BLOCKSIZE=1024                 # 每块有1K (1024 byte) 的大小    
DEVICE=/dev/ram0               # 第一个 ram 设备    
    
username=`id -nu`    
if [ "$username" != "$ROOTUSER_NAME" ]    
then    
  echo "Must be root to run ""`basename $0`""."    
  exit $E_NON_ROOT_USER    
fi    
    
if [ ! -d "$MOUNTPT" ]         # 测试挂载点是否已经存在了,    
then                           #+ 如果这个脚本已经运行了好几次了就不会再建这个目录了    
  mkdir $MOUNTPT               #+ 因为前面已经建立了.    
fi    
    
dd if=/dev/zero of=$DEVICE count=$SIZE bs=$BLOCKSIZE # 把RAM设备的内容用零填充.    
                                                      # 为何需要这么做?    
mke2fs $DEVICE                 # 在RAM设备上创建一个ext2文件系统.    
mount $DEVICE $MOUNTPT         # 挂载设备.    
chmod 777 $MOUNTPT             # 使普通用户也可以存取这个ramdisk，但是, 只能由root来缷载它.    
    
echo """$MOUNTPT"" now available for use."    
# 现在 ramdisk 即使普通用户也可以用来存取文件了.    
# 注意, ramdisk是易失的, 所以当计算机系统重启或关机时ramdisk里的内容会消失.    
# 重启之后, 运行这个脚本再次建立起一个 ramdisk.    
# 仅重新加载 /mnt/ramdisk 而没有其他的步骤将不会正确工作.    
# 如果加以改进, 这个脚本可以放在 /etc/rc.d/rc.local，以使系统启动时能自动设立一个ramdisk。这样很合适速度要求高的数据库服务器.    
exit 0 
```







