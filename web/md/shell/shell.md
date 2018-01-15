shell可以做什么
================================================================================
- 管理主机的任务有查询登录文件、追踪流量、监控用户使用主机状态、主机各项硬件设备状态、主机软件更新查询
- 追踪和管理系统的重要工作
- 简单入侵检测功能
- 连续命令单一化
- 简易的数据处理
- 跨平台支持与学习历程较短
- Linux启动中，各种服务的自动开启
- 清除过期文件、机器老化、自动化测试等等的无人值守执行
- 软件开发的持续集成，提交代码后，迅速编译、打包、运行测试，给出反馈
- 各种服务器、数据库的维护、备份


# Bash 特征
- 目录处理,包含 pushd, popd 和 dirs 命令
- 作业控制,包括 `fg` 和 `bg` 命令,以及使用CRTL-Z停止作业
- 大括号扩展,可以产生任意的字符串
- `~`扩展,指代用户根目录的缩写
- 别名,让你为命令或命令行定义缩写名称
- 命令历史,让你记得以前输入的指令
- 命令行编辑,使用emacs或vi风格
- 键盘绑定,让你设置自定义编辑的键序列
- 集成编程特性,包含几个 UNIX 外部命令的功能,包括 test、expr、getopt、echo 等,使得编程任务能更简洁有效地完成
- 控制结构,特别是select结构,能简单生成菜单
- 新的选项与变量,使得你有更多的途径来定制你的环境
- 一维数组,使得引用与操作数据列表更为简单
- 动态加载built-in命令,自定义命令并加载进shell的功能。

# 启动方式
#### 交互式启动 Login-shell
交互式 login 启动时读取以下系统级别和用户级别的启动文件;交互式 non-login 启动时读 取以下 Bash 级别启动文件
1. 系统级别,由 `/etc/profile` 文件控制。这个文件在Bash shell启动时被执行。它可被系统所有 sh 和 ksh 用户使用。
2. 用户级别,由 `~/.bash_profile` (或者 `~/.bash_login`,或者 `~/.profile` )和 `~/.bash_logout` 文件控制。这些文件控制登录用户的基本登录和退出环境。
3. Bash 级别(子 shell 级别),由 `~/.bashrc` 文件控制。每次一个新的 Bash shell 启动时 将自动执行 `~/.bashrc` 文件,用来配置只属于 Bash shell 的环境。

- `~/.bashrc` 一般会含有以下语句

```bash
if [ -f /etc/bashrc ];
    then . /etc/bashrc
fi
```
`/etc/bashrc` 一般用来设置所有 Bash shell 公用的变量

- 系统配置文件/etc/profile文件中一般有如下语句

```bash
for i in /etc/profile.d/*.sh ;
    do if [ -r "$i" ]; then
. $i
fi done
```
系统会在初始化时运行/etc/profile.d/目录下的所有可读.sh 脚本。




shell编程要注意什么
================================================================================
- 命令从上而下，从左至右分析和执行
- 命令、参数间的多个空白会被忽略
- 空白行也会被忽略
- 如果读取到一个Enter符号，就尝试执行该行命令
- 如果一行代码太多，可以用[enter]来进行扩展
- #作为注释

Bash 的实现原理
================================================================================
bash使用GNU Readline库处理用户命令输入，Readline提供类似于vi或emacs的行编辑功能。
bash运行时的调度中心是其主控循环。主控循环的功能较为简单，它循环读取用户（或脚本）输入，传递给
语法分析器，同时处理下层递归返回的错误。
语法分析器对文本形式的输入首先进行通配符、别名、算术和变量展开等工作，然后通过命令生成器得到
规范的命令结构，并由专门的重定向处理机制填写重定向语义，交由命令执行器执行。命令执行器依据
命令种类不同，执行内部命令函数、外部程序或文件系统调用。在命令执行过程中，执行器要对系统信号
进行捕获和处理。在支持作业管理的操作系统中，命令执行器将进程信息加入作业控制机制，并允许用户
使用内部命令或键盘信号来启停作业。如果在不支持作业管理的操作系统中编译bash，会使用另一套接口
相同的机制对进程信息进行简单的维护。


如何执行shell脚本
================================================================================
- 绝对路径：/path/to/your/shell.sh
- 相对路径: ./shell.sh
- 将shell.sh存放在PATH指定的目录
- 以bash进程来执行：bash shell.sh sh shell.sh
- 利用直接执行的方式来执行script:该script会使用一个新的bash环境执行的脚本内容，中途产生的变量不会回传到父进程中
- 利用source执行脚本，会在父进程中进行

变量
================================================================================
```bash
var=value # 定义变量并且赋值
unset value # 删除变量
echo $var # 显示变量
declare [-aixr] var #声明变量类型 -a:数组，-i:整形，-x:效果同于export,-r:变量设置为readonly,变量定义后默认为字符型

#通过交互获取用户输入的变量
read -p "提示信息" 变量名

#显示信息
echo -e "输出信息 $变量名"

# 将变量声明为环境变量(全局变量)
export var
```

函数
================================================================================
```bash
# 定义函数
function printit(){
    echo -n "This is a simple test ";
    echo "$1"; # 打印第一个参数 $2 是第二个
    echo "$@"; # 以列表的形式打印出所有的参数
    echo "$*"; # 所有的参数作为单个实体
    return 0; # 返回值 0 为成功， 非 0 为错误
}
# 调用函数
printit arg1 arg2

echo $?; # 在调用函数后，马上使用 $? 获取函数 return 的值

export -f printit ; # 导出函数为全局函数， 这样在子进程中，也能使用该函数了
```
- shell命令执行时首先从函数开始，如果自定义了一个与内建命令同名的函数，那么就执行这个函数而非真正的内建命令
- `:(){:|:&}:` 这个是fork炸弹, : 是函数名，递归在后台调用自身，不断的fork进程，直到拖垮系统

判断语句
================================================================================
```bash
#!/bin/bash
if [判断1]; then
    执行内容
##多重判断
elif [判断2]; then
    执行内容
else
    执行内容
#结束    
fi
```

循环语句
================================================================================
```bash
# while do... done循环
while [condition]
do #循环开始
    程序段落
done #循环结束
#until do ...done循环
until [condition]
do
    程序段落
done
# for...do...done（固定循环)
for var in cond1 cond2 cond3...
do
    执行语句
done
#或类似于C语言
for ((i=1;i<=$num;i=i+1));do
    echo $i
done
```

# 命令行快捷键
```bash
[Tab] 自动补充
[Ctrl] + a 到正在输入的命令行的头部
[Ctrl] + e 到正在输入的命令行的尾部
[Ctrl] + c 终止当前进程
[Ctrl] + k 删除光标后的所有字符
```

# 命令行可以使用通配符
```bash
* 代表任意字符串
? 代表一个字符
[abcd] 代表从a, b, c, d选字符
[!abcd] 代表除这些字符串之外
[1-9] 匹配1到9
[a-z] 表示a到z
```

# `&&` 与 `||` 控制程序执行流程
```bash
# 前面命令执行成功后，才执行后面命令
sudo service apache2  stop && sudo  service apache2  start
# 前面命令执行失败后，后面命令才执行
service apache2 restart || sudo service apache2 restart
```

# 命令的输入与输出
```bash
ls -l /tmp > tmp.msg     # >表示覆盖重定向 将 ls -l /tmp 的输出纪录到 /tmp.msg 中
date >> /tep.msg         # >>表示在末尾追加
grep 127 < /etc/hosts    # <输入重定向
ps aux | grep  apache2   # 管道| 将左边命令的输出作为右边命令的输入
ls  -l  `which touch`     # 命令替换符`` 将 which touch的输出作为 ls -l 的输入
```

# jobs 程序栈管理
```bash
[Ctrl] ＋ z  将当前执行的命令放入后台栈中(入栈)
tail -f /etc/bashrc & 直接丢进后台运行(入栈)
jobs 查看后台栈中运行的程序,最前面的是它的序列号
fg 将放入后台的程序切换回前台(出栈)
```

# 文件访问
**文件类型及其标志**
```
- 普通文件  d 目录文件  l 链接文件(软链接和硬链接)  b 块设备文件
c 字符设备文件   s 套接字文件socket   p 命名管道文件pipe
```
**硬链接**
> linux 使用索引文件系统,在同一分区下,每创建一个文件都会分配一个`inode`指向这个文件
> 而我们的文件名都是指向`inode`的,可以使用多个`路径/文件名`指向这个`inode`,这些文件名彼此就是硬链接
> 硬链接不能跨分区！不能针对目录使用！硬链接相当于有copy + 实时更新的功能,因为真正的文件只有一份 `block`存储 所以也不会浪费磁盘空间
文件名--->分区表`inode`节点----->block块
`ln source.txt  /var/source.txt`   创建硬链接

**软链接**
> 你---->软链接`inode`--->软链接`block`---->原文件`inode`---->原文件`block`
`ln -s  source.txt  /var/source_link.txt`  创建软连接（相当于快捷方式）


# 文件和目录命令
`ls  -aldh  /root`  显示/root下所有文件
`pwd`   显示当前目录
`touch  test.c`   创建一个新文件test.c
`mkdir -p    /var/www/advanced`     递归创建目录
`rm    -rf    /mydir`     强制删除/mydir目录和里面的文件
`cp  test.c   /root/test.c`         复制文件
`cp  -r /var/www/abc  /var/www/dcf`  复制目录 -a 是复制文件与原文件一模一样
`https://linux.cn/article-2687-1.html` cp 命令的各种碉堡的用法

`mv  test.c  /root/test1.c`    移动文件  (移动和复制都是有改名的效果的)
`mv  /var/www/abc/  /root/def/`   移动目录
`https://linux.cn/article-2688-1.html`  mv 命令
`more  Myfile` 分页查看文件内容，空格：下一页，enter：下一行，q：退出
`tail -f debug.log` 动态监看日志

# 压缩和解压
`gzip -d`      文件：压缩为 .gz文件，不支持目录，不保留源文件，-d 为解压缩
`bzip2  -k`    文件：压缩为.bz2 文件，它的压缩比非常惊人，-k 会保留源文件
`bunzip2`    .bz2文件：解压 .bz2 文件。
`tar  -zxvf   aa.tar.gz`   解压到当前文件夹
`tar  -zcvf   aa.tar.gz  /etc/aa.txt`   压缩文件，记得文件用全路径
`zip  services.zip  /etc/services`  压缩文件
`zip  test.zip  /test`  压缩目录 zip 是保留源文件的压缩


# 文件权限
`chmod  [-R]  777    /var/home/www`    改变文件/目录权限 -R是递归
`chown  [-R] caokaiyan   /var/home/www`    改变文件所有者
`chown  [-R] caokaiyan:admin   /var/home/www`    同时改变文件所有者和用户组
`chgrp  [-R]  admin  /var/home/www`    改变文件所有组

# 网络通信命令
`ping    + ip地址/URL`
发送数据包，看看能不能得到包的返回ping    自己机器ip地址：如果能通，说明自己的网络设置是没问题的！
`ping    127.0.0.1(回环地址)` 检测自己机器安装了tip/ip 协议 么
`ping   + 6000    www.baidu.com`
发送 6000    block 大小的一个包，来测试网络连接时延
`ifconfig -a `
查看网卡信息；eth0是第一块网卡  lo 是回环网卡；
`netstat -anp`
监控网络状态，端口号，哪个进程监听的这个端口啊，等等！
`traceroute  +域名/主机 IP `
追踪路由route -n：显示本机路由表
`dig domain`  获取domain的DNS信息
`dig -x host`  逆向查询host
`wget file`  下载file
`wget -c file`  断点续传file

# 源代码安装软件
```bash
./configure
make
make install
```
#安装软件包
`rpm -Uvh pkg.rpm` redhat 系
`dpkg -i pkg.deb` debian 系


# 关机
`shutdown  -h` [now/等待时间]
`shutdown  -r`    [now/等待时间]
`reboot`    快速重启（跳过sync数据同步过程）
`init    0`    关机
`init    6`    重启
`halt`    系统停机



# 查看硬盘分区情况
`fdisk    -l    [/dev/had]`硬盘分区情况
`df    -h`    硬盘分区的使用情况
`du    -sh   /root`    查看`/root`下所有目录大小


# linux环境配置
`Locale`    查看当前语言环境
`LANG=zh_CN.UTF-8`设置当前语言,`LANG` 是环境变量可以使用配置环境变量，而不用去修改对应的配置文件
`env`    列出所有的环境变量
`date`   显示当前时间
`cal`    显示当前日历
`env`    列出所有环境变量和值
`set`    列出所有已经生效的变量

# 挂载命令
`mount` 直接回车 显示当前已经挂载的盘

```bash
/dev/sda3 on / type ext4 (rw)
proc on /proc type proc (rw)
sysfs on /sys type sysfs (rw)
devpts on /dev/pts type devpts (rw,gid=5,mode=620)
tmpfs on /dev/shm type tmpfs (rw,rootcontext="system_u:object_r:tmpfs_t:s0")
/dev/sda1 on /boot type ext4 (rw)
none on /proc/sys/fs/binfmt_misc type binfmt_misc (rw)
```

`mount -a` 将`/etc/fstab`自动挂载设备再挂载一遍
开机自动挂载
```bash
[cky@localhost ~]$ cat /etc/fstab

# /etc/fstab
# Created by anaconda on Mon Sep  5 13:46:59 2016
#
# Accessible filesystems, by reference, are maintained under '/dev/disk'
# See man pages fstab(5), findfs(8), mount(8) and/or blkid(8) for more info
#
UUID=a9555e9b-6dbc-446b-b919-3ae2ba3a36c9 /                       ext4    defaults        1 1
UUID=1b581ee5-8dbd-4da0-8ea5-6d69e7936e58 /boot                   ext4    defaults        1 2
UUID=c56751cf-0688-4cdc-9304-749c886af943 swap                    swap    defaults        0 0
tmpfs                   /dev/shm                tmpfs   defaults        0 0
devpts                  /dev/pts                devpts  gid=5,mode=620  0 0
sysfs                   /sys                    sysfs   defaults        0 0
proc                    /proc                   proc    defaults        0 0
```
- `mount [-t] [-o] 设备文件名 挂载点`
- -t 文件系统 ext3 ext4 iso9660
- -o 特殊选项

# 查看当前shell的所有变量
`set`

# centos 命令
##服务相关
`systemctl start|stop|restart nginx.service` 启动｜关闭｜重启某项服务
`systemctl enable httpd.service` 开机自启动
`systemctl disable httpd.service` 关闭开机自启动
`systemctl status httpd.service` 查看服务状态
`systemctl list-units --type=service` 列出启动的服务

## 更新yum源到阿里云
第一步：备份你的原镜像文件，以免出错后可以恢复。
mv /etc/yum.repos.d/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo.backup
wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-6.repo
第三步：运行yum makecache生成缓存
yum makecache

#查看版本
`lsb_release -a` 查看发行版本
`uname -a` 查看内核版本

`cat /etc/redhat-release`
`cat /proc/version`

# yes
`yes "hscripts"`
上述命令将重复的显示hscripts直到按下热键终止它(CTRL+C)。
当删除文件需要确认时，不用按键就删除文件:
`yes | rm -i *.txt`
在上述示例中，yes命令与带着rm命令管道运行。 通常rm -i命令提示你删除文件, 你必须敲入y（是）或n（不）来删除文件。 当与 yes 管道运行时， yes 的默认值将显示yes和所有将被自动删除的文件，因此你不需要对每个txt文件敲入y来删除它。
`yes n | rm -i *.txt`
在上述示例中，当 rm -i 确认删除文件的时候，敲入n代表not不删除文件。
