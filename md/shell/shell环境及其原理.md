# Bash 的实现原理
- `Bash` 使用 `GNU Readline库` 处理用户命令输入，`Readline` 提供类似于 `vi` 或 `emacs` 的行编辑功能。
- `Bash` 运行时的调度中心是其主控循环。主控循环的功能较为简单，它循环读取用户（或脚本）输入，传递给语法分析器，同时处理下层递归返回的错误。
    1. 语法分析器对文本形式的输入首先进行通配符、别名、算术和变量展开等工作
    1. 通过命令生成器得到规范的命令结构，并由专门的重定向处理机制填写重定向语义，交由命令执行器执行。
    1. 命令执行器依据命令种类不同，执行内部命令函数、外部程序或文件系统调用。
    1. 在命令执行过程中，执行器要对系统信号进行捕获和处理。
        - 在支持作业管理的操作系统中，命令执行器将进程信息加入作业控制机制，并允许用户使用内部命令或键盘信号来启停作业。
        - 在不支持作业管理的操作系统中编译bash，会使用另一套接口相同的机制对进程信息进行简单的维护。


# 提出问题
- 我们经常会碰到这样的问题，用 `telnet/ssh` 登录了远程的 Linux 服务器，运行了一些耗时较长的任务， 结果却由于网络的不稳定导致任务中途失败。如何让命令提交后不受本地关闭终端窗口/网络断开连接的干扰呢？
- 在 Unix 的早期版本中，每个终端都会通过 modem 和系统通讯。当用户 logout 时，modem 就会挂断（hang up）电话。 同理，当 modem 断开连接时，就会给终端发送 hangup 信号来通知其关闭所有子进程。解决方法：我们知道，当用户注销（logout）或者网络断开时，终端会收到 HUP（hangup）信号从而关闭其所有子进程。因此，我们的解决办法就有两种途径：要么让进程忽略 HUP 信号，要么让进程运行在新的会话里从而成为不属于此终端的子进程。

# nohup
- nohup 的用途就是让提交的命令忽略 hangup 信号
- 标准输出和标准错误缺省会被重定向到 nohup.out 文件中。一般我们可在结尾加上`&`来将命令同时放入后台运行，也可用` >filename 2>&1 `来更改缺省的重定向文件名

```bash
cky@cky-pc:~$ nohup ping www.baidu.com &> ping.log &
[1] 9587
cky@cky-pc:~$ tail -f ping.log
nohup: 忽略输入
PING www.a.shifen.com (14.215.177.37) 56(84) bytes of data.
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=1 ttl=55 time=7.82 ms
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=2 ttl=55 time=5.40 ms
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=3 ttl=55 time=6.02 ms
```

# setsid
- setsid 能让我们的进程不属于接受 HUP 信号的终端的子进程

```bash
cky@cky-pc:~$ setsid ping www.baidu.com &> setsid_ping.log
cky@cky-pc:~$ tail -f setsid_ping.log
PING www.a.shifen.com (14.215.177.37) 56(84) bytes of data.
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=1 ttl=55 time=5.41 ms
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=2 ttl=55 time=6.52 ms
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=3 ttl=55 time=5.39 ms
64 bytes from 14.215.177.37 (14.215.177.37): icmp_seq=4 ttl=55 time=7.39 ms

# 关闭当前终端后，进程还在执行，所以必须要用kill -9 PID 杀死它
```


# `&` + `()` 后台运行
- 将一个或多个命名包含在 `()` 中就能让这些命令在子 shell 中运行中，从而扩展出很多有趣的功能，我们现在要讨论的就是其中之一
```bash
cky@cky-pc:~/workspace/shell$ (ping www.baidu.com &> abc.log &)
cky@cky-pc:~/workspace/shell$ tail -f abc.log
PING www.a.shifen.com (14.215.177.38) 56(84) bytes of data.
64 bytes from 14.215.177.38 (14.215.177.38): icmp_seq=1 ttl=55 time=7.55 ms
64 bytes from 14.215.177.38 (14.215.177.38): icmp_seq=2 ttl=55 time=5.42 ms
# 关闭当前终端后，进程还在运行
```

# disown
- 用 `CTRL-z `来将当前进程挂起到后台暂停运行，然后用`bg %job_id`来使它恢复活动，然后再用下列命令使它忽略HUP信号
- 用`disown -h %2 `来使某个作业忽略HUP信号。
- 用`disown -ah `来使所有的作业都忽略HUP信号。
- 用`disown -rh `来使正在运行的作业忽略HUP信号。

```bash
cky@cky-pc:~/workspace/shell$ ping www.baidu.com &> jobs.log
^Z
[1]+  已停止               ping www.baidu.com &> jobs.log
cky@cky-pc:~/workspace/shell$ disown -h %1
```

# tmux
- screen作为一个老牌的终端屏幕管理软件完全满足我的日常需求，唯一的缺憾是screen没有分屏的功能。tmux是这样一款软件，它包含了99%的screen功能，而且它具有屏幕分屏的功能。
通过修改tmux的配置，调整快捷键，理论上screen用户可以无缝切换到tmux。



# 启动方式
#### 交互式启动 Login-shell
- 交互式 login 启动时读取以下系统级别和用户级别的启动文件;交互式 non-login 启动时读 取以下 Bash 级别启动文件
    1. 系统级别,由 `/etc/profile` 文件控制。这个文件在Bash shell启动时被执行。它可被系统所有 sh 和 ksh 用户使用。
    2. 用户级别,由 `~/.bash_profile` (或者 `~/.bash_login`,或者 `~/.profile` )和 `~/.bash_logout` 文件控制。这些文件控制登录用户的基本登录和退出环境。
    3. Bash 级别(子 shell 级别),由 `~/.bashrc` 文件控制。每次一个新的 Bash shell 启动时 将自动执行 `~/.bashrc` 文件,用来配置只属于 Bash shell 的环境。

- `~/.bashrc` 一般会含有以下语句, `/etc/bashrc` 一般用来设置所有 Bash shell 公用的变量

    ```bash
    if [ -f /etc/bashrc ];
        then . /etc/bashrc
    fi
    ```

- 系统配置文件/etc/profile文件中一般有如下语句 , 系统会在初始化时运行 `/etc/profile.d/` 目录下的所有可读.sh 脚本。

    ```bash
    for i in /etc/profile.d/*.sh ;
        do if [ -r "$i" ]; then
    . $i
    fi done
    ```

- 用户登录时默认不会 `source ~/.bashrc` 文件,如果要用需要自行在脚本中加入。这 也是一般在.bash_profile 文件中有以下语句的原因:
    ```bash
    if [ -f ~/.bashrc ];
        then . ~/.bashrc
    fi
    ```

- 所有配置文件的执行顺序如下, 系统只自动读取`/etc/profile`, `~/.bash_profile` 和 `~/.bash_logout` , 其余是自 定义的
    ```bash
    |- /etc/profile --> /etc/profile.d/*.sh
    |- ~/.bash_profile (or ~/.bash_login, or ~/.profile)
    |               --> ~/.bashrc
    |                        -->  /etc/bashrc
    |- ~/.bash_logout (退出时)
    ```

#### 非交互式启动
- 当 Bash 通过运行 shell 脚本的方式启动时就是非交互式的。非交互式启动时,它将查看环境变量 BASH_ENV,扩展其值并运行它,就像运行了以下命令:
    ```bash
    if [ -n "$BASH_ENV" ] ;then 
        . "$BASH_ENV";
    fi
    ```

- 判断shell是否是交互式启动
    ```bash
    if [ -z "$PS1" ]; then
        echo "通过脚本运行";
    else
        echo "直接敲命令运行的";
    fi
    ```

- 当shell交互式启动时,有以下不同于非交互式启动的行为:
    1. 读入初始化文件;
    1. 作业控制默认启动;
    1. 显示PS1,PS2;
    1. 命令行编辑功能;
    1. 命令历史功能
    1. 别名扩展
    1. 定期检查邮件,根据 MAIL, MAILPATH, MAILCHECK 配置
    1. 扩展错误、重定向错误、exec错误、解析命令错误等不会引起Bash退出
    1. 检查TMOUT的值,如果固定秒在打印 $PS1 后没有命令读入退出


# 如何执行shell脚本
- 绝对路径：/path/to/your/shell.sh
- 相对路径: ./shell.sh
- 将shell.sh存放在PATH指定的目录
- 以bash进程来执行：bash shell.sh sh shell.sh
- 利用直接执行的方式来执行script:该script会使用一个新的bash环境执行的脚本内容，中途产生的变量不会回传到父进程中
- 利用source执行脚本，会在父进程中进行










# `/etc` 配置文件
- `/etc/lilo.conf `   启动引导程序文件
- `/etc/grub.conf`     多系统引导时，配置文件
- `/etc/inittab `   控制启动模式（图形/文本登录）
- `/etc/fstab`   文件系统配置
- `/etc/profile`    增加环境变量等的配置文件 如PATH 如配置javaEE 开发环境
- `/etc/ftp*`    ftp 的配置文件
- `/etc/ssh*`    ssh的配置文件
- `/etc/resolv.conf`    dns域名服务器的配置文件
- `/etc/passwd`    系统能识别的用户清单，纯文本显示加密了的口令，普通用户可读
- `/etc/shadow`    超级用户才能读，用于保护加密口令的安全，隐藏口令
- `/etc/group`    放置所有组名的地方
- `/etc/sysconfig/network-scripts/ifcfg-etho`    ip地址的配置文件
- `/etc/hosts`    类似于window  host 文件的

# /dev/null
```bash
cat file 2>/dev/null # 将stderr重定向到 /dev/null ，这样就不会输出到控制台了
cat /dev/null > /var/log/file # 将file清空　，而又不删除它

if [ -f ~/.netscape/cookies ];then    # 如果存在则删除，删除后才可以添加软链接  
    rm -f ~/.netscape/cookies
fi    
ln -s /dev/null ~/.netscape/cookies  # 建立到/dev/null的软链接，这时所有该存到文件的输入都被丢入/dev/null了
```
- 或称空设备，是一个特殊的设备文件，它丢弃一切写入其中的数据（但报告写入操作成功），读取它则会立即得到一个EOF。通常被用于丢弃不需要的输出流

# /dev/zero
```bash
dd if=/dev/zero of=/dev/sdb bs=4M # 把/dev/sdb 清零
```
- 是一个特殊的文件，当你读它的时候，它会提供无限的空字符(NULL, ASCII NUL, 0x00)。
- 典型用法是用它提供的字符流来覆盖信息
- 另一个常见用法是产生一个特定大小的空白文件
- ELF二进制文件利用了/dev/zero

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



# 子shell
```bash
#!/bin/bash
count=$(ls | cat -n | wc -l)
echo "共有$count个子文件"

(cd /bin; ls | wc -l); # () 产生一个子进程，子进程不会对当前shell有任何影响

count2=`ls | cat -n | wc -l` # 与 $() 相同
echo "count2 : $count2";

out="$(cat text.txt)" # 使用"号的子进程，会保留空格和换行符。。。。貌似没用啊
echo $out

# cky@cky-pc:~/workspace/shell$ ./son_shell.sh 
# 共有51个子文件
# 167
# count2 : 51
# 1 2 3
```