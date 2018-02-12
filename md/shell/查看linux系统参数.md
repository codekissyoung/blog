# 观察内存状态 cat /proc/meminfo
```bash
➜  blog git:(master) ✗ cat /proc/meminfo
MemTotal:        8056516 kB
MemFree:         4403196 kB
MemAvailable:    6264224 kB
Buffers:          381480 kB
Cached:          1689388 kB
SwapCached:            0 kB
Active:          2302344 kB
Inactive:         883236 kB
...
```

# ipcs 查看进程的共享内存 消息队列 信号量
```bash
➜  blog git:(master) ✗ ipcs

--------- 消息队列 -----------
键        msqid      拥有者  权限     已用字节数 消息      

------------ 共享内存段 --------------
键        shmid      拥有者  权限     字节     连接数  状态      
0x00000000 98304      cky        600        16777216   2                       
0x00000000 4292609    cky        600        1048576    2          目标       
--------- 信号量数组 -----------
键        semid      拥有者  权限     nsems     
```

# 开启启动服务
- 标准启动运行级别 3
- 开心图形化界面的运行级别 5
- ubuntu 开机启动脚本在 /etc/rcX.d/目录下， X 是运行级别, 标准Linux 在 /etc/inittab 文件中
```bash
➜  ~ ls -alh /etc/rc5.d
总用量 16K
drwxr-xr-x   2 root root 4.0K 5月  28 15:38 .
drwxr-xr-x 147 root root  12K 6月  12 17:07 ..
lrwxrwxrwx   1 root root   15 1月  14 23:39 S01acpid -> ../init.d/acpid
lrwxrwxrwx   1 root root   17 1月  14 23:39 S01anacron -> ../init.d/anacron
lrwxrwxrwx   1 root root   16 1月  14 23:39 S01apport -> ../init.d/apport
lrwxrwxrwx   1 root root   22 1月  14 23:39 S01avahi-daemon -> ../init.d/avahi-daemon
...
```

# 查看系统正在运行的所有进程
```bash
➜  ~ ps aux  显示了系统所有进程
USER       PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
root         1  0.0  0.0 205172  7472 ?        Ss   6月11   0:03 /sbin/init splash
...

➜  md git:(master) ✗ ps axjf  显示了进程 子进程之间关系
1256  2414  2414  2414 ?           -1 Ssl   1000   0:00  \_ /usr/lib/zeitgeist/zeitgeist/zeitgeist-fts
1256  3104  3104  3104 ?           -1 Ssl   1000   1:25  \_ /usr/lib/gnome-terminal/gnome-terminal-server

➜  md git:(master) ✗ ps lax   长模式 ，显示了 PPID 谦让值 NI 进程正在等待的资源
F   UID   PID  PPID PRI  NI    VSZ   RSS WCHAN  STAT TTY        TIME COMMAND
4     0     1     0  20   0 205172  7472 -      Ss   ?          0:03 /sbin/init splash
1     0     2     0  20   0      0     0 -      S    ?          0:00 [kthreadd]
```

# 硬件设备管理
- 字符型设备文件，调制解调器，终端
- 块设备文件,硬盘
- 网络设备文件,采用数据包发送和接受数据的设备，比如各种网卡和特殊的回环设备
```bash
➜  ~ cd /dev
➜  /dev ls -alh sda* tty*
                     主设备号 次设备号
brw-rw---- 1 root disk    8,  0 6月  11 14:09 sda  块设备
brw-rw---- 1 root disk    8,  1 6月  11 14:09 sda1
brw-rw---- 1 root disk    8,  2 6月  11 14:09 sda2
brw-rw---- 1 root disk    8,  3 6月  11 14:09 sda3
crw-rw-rw- 1 root tty     5,  0 6月  14 14:24 tty 字符设备
crw--w---- 1 root tty     4,  0 6月  11 14:09 tty0
crw--w---- 1 root tty     4,  1 6月  11 14:09 tty1
...
```

# 文件系统管理
- linux 采用 VFS (Virtual File System)作为和每个文件系统交互的接口


# linux 桌面环境
- X.org 软件包是 X Window的实现，是直接和PC的显卡以及显示器一起工作的底层软件
- X Window 系统之上的桌面环境:KDE / GNOME / XFACE

# 终端模拟器
- 哑终端--->Linux控制台--->终端模拟包--->
- 字符集：将二进制字符代码转化成字符发送给显示器显示，ascii ios unicode
- 控制码: 控制光标在显示器上的显示位置，如回车 换行 水平制表符 方向键 翻页键 清空控制台
- 块模式图形:
- 矢量图形:
- 显示缓冲: 1.滚动缓冲 2.替代缓冲
- 色彩:
- 键盘: 终端模拟包需要实现键盘模拟, 中断 ，滚动锁定 ， 重复 ，返回 ， 删除 ，方向键 ，功能键
- terminfo数据库: 是一组文件，标识了各种可以用在linux系统上的终端的特性，常见路径`/usr/share/terminfo` `/etc/terminfo` `/lib/terminfo`

```bash
➜  ~ cd /lib/terminfo/v
➜  v ls
vt100  vt102  vt220  vt52
➜  v infocmp vt100  列出终端定义的功能，以及用来模拟每个功能的控制码
#	Reconstructed via infocmp from file: /lib/terminfo/v/vt100
vt100|vt100-am|dec vt100 (w/advanced video),
	am, mc5i, msgr, xenl, xon,
	cols#80, it#8, lines#24, vt#3,
	acsc=``aaffggjjkkllmmnnooppqqrrssttuuvvwwxxyyzz{{||}}~~,
...
```

- 查看shell会话使用哪个终端模拟设置

```bash
echo $TERM
xterm-256color   说明终端类型设置为了 terminfo 数据库中的xterm条目
```

- 虚拟控制台: 现代Linux启动时，会自动创建几个虚拟控制台，它是Linux内存中的终端会话，`Ctrl + Alt + [F1~F8]`来切换各个虚拟控制台
- X Window 终端模拟包: Xterm Konsole Gnome-Terminal


vmstat
================================================================================
```bash
cky@cky-pc:~$ vmstat 1 3 # 每隔一秒刷新一次输出 总共刷新3次
procs -----------memory---------- ---swap-- -----io---- -system-- ------cpu-----
 r  b 交换 空闲 缓冲 缓存   si   so    bi    bo   in   cs us sy id wa st
 1  0      0 3918024 125876 2305964    0    0    22    17   70  303  3  1 96  1  0
 0  0      0 3917984 125876 2306100    0    0     0     0  414  745  1  1 99  0  0
 0  0      0 3918024 125876 2306180    0    0     0     0  190  586  1  0 99  0  0
```
- in : 每秒被中断的进程次数
- cs : 每秒钟进行的事件切换次数,值越大，代表系统与接口设备的通信越繁忙
- us : 非内核进程消耗cpu运算时间的百分比
- sy : 内核进程消耗cpu运算时间的百分比
- id : 空闲cpu的百分比
- wa : 等待 I/O 所消耗的cpu百分比
- st ：被虚拟机所盗用的cpu占比


free 查看内存
================================================================================
```bash
cky@cky-pc:~$ free -h
              总计         已用        空闲      共享    缓冲/缓存    可用
内存：        7.7G        1.6G        3.7G        412M        2.3G        5.4G
交换：        7.9G          0B        7.9G
```

/proc/cpuinfo　查看cpu详细信息
================================================================================
```bash
cky@cky-pc:~$ cat /proc/cpuinfo 
processor	: 0
vendor_id	: GenuineIntel
cpu family	: 6
model		: 58
model name	: Intel(R) Core(TM) i5-3210M CPU @ 2.50GHz
stepping	: 9
microcode	: 0x1c
cpu MHz		: 1199.951
cache size	: 3072 KB
physical id	: 0
siblings	: 4
core id		: 0
cpu cores	: 2
apicid		: 0
initial apicid	: 0
fpu		: yes
...
```

uptime 查看系统平均负载
================================================================================
```bash
cky@cky-pc:~$ uptime
 15:55:30 up  5:25,  1 user,  load average: 0.32, 0.27, 0.21
```


lsof 查看进程调用的文件 
================================================================================
```bash
cky@cky-pc:~$ lsof /sbin/init # 查看某个文件(系统文件)被哪个进程调用
COMMAND  PID USER  FD   TYPE DEVICE SIZE/OFF     NODE NAME
systemd 1359  cky txt    REG    8,2  1141448 18350174 /lib/systemd/systemd
cky@cky-pc:~$ lsof -c httpd # 查看httpd进程调用了哪些文件(系统文件)
cky@cky-pc:~$ lsof -u root # 查看该用户的进程调用的文件(系统文件)
COMMAND     PID USER   FD      TYPE DEVICE SIZE/OFF NODE NAME
systemd       1 root  cwd   unknown                      /proc/1/cwd (readlink: Permission denied)
systemd       1 root  rtd   unknown                      /proc/1/root (readlink: Permission denied)
systemd       1 root  txt   unknown                      /proc/1/exe (readlink: Permission denied)
kthreadd      2 root  cwd   unknown                      /proc/2/cwd (readlink: Permission denied)
...
```

dmesg 内核启动自检信息
================================================================================
```bash
cky@cky-pc:~$ dmesg
[    0.000000] microcode: microcode updated early to revision 0x1c, date = 2015-02-26
[    0.000000] Linux version 4.10.0-22-generic (buildd@lcy01-08) (gcc version 6.3.0 20170406 (Ubuntu 6.3.0-12ubuntu2) )
[    0.000000] KERNEL supported cpus:
[    0.000000]   Intel GenuineIntel
[    0.000000]   AMD AuthenticAMD
[    0.000000]   Centaur CentaurHauls
[    0.000000] x86/fpu: Supporting XSAVE feature 0x001: 'x87 floating point registers'
[    0.000000] x86/fpu: Supporting XSAVE feature 0x002: 'SSE registers'
[    0.000000] x86/fpu: Supporting XSAVE feature 0x004: 'AVX registers'
[    0.000000] x86/fpu: xstate_offset[2]:  576, xstate_sizes[2]:  256
...
```


