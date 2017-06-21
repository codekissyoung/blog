# 观察内存状态
```
➜  blog git:(master) ✗ cat /proc/meminfo
MemTotal:        8056516 kB
MemFree:         4403196 kB
MemAvailable:    6264224 kB
Buffers:          381480 kB
Cached:          1689388 kB
SwapCached:            0 kB
Active:          2302344 kB
Inactive:         883236 kB
Active(anon):    1115988 kB
Inactive(anon):   221104 kB
Active(file):    1186356 kB
Inactive(file):   662132 kB
Unevictable:         120 kB
Mlocked:             120 kB
SwapTotal:       8270844 kB
SwapFree:        8270844 kB
Dirty:                36 kB
Writeback:             0 kB
AnonPages:       1077540 kB
Mapped:           373964 kB
Shmem:            222384 kB
Slab:             357528 kB
SReclaimable:     317396 kB
SUnreclaim:        40132 kB
KernelStack:        8080 kB
PageTables:        36520 kB
NFS_Unstable:          0 kB
Bounce:                0 kB
WritebackTmp:          0 kB
CommitLimit:    12299100 kB
Committed_AS:    4845740 kB
VmallocTotal:   34359738367 kB
VmallocUsed:           0 kB
VmallocChunk:          0 kB
HardwareCorrupted:     0 kB
AnonHugePages:    559104 kB
ShmemHugePages:        0 kB
ShmemPmdMapped:        0 kB
CmaTotal:              0 kB
CmaFree:               0 kB
HugePages_Total:       0
HugePages_Free:        0
HugePages_Rsvd:        0
HugePages_Surp:        0
Hugepagesize:       2048 kB
DirectMap4k:      184336 kB
DirectMap2M:     8087552 kB
```

# 查看进程的共享内存 消息队列 信号量
```
➜  blog git:(master) ✗ ipcs

--------- 消息队列 -----------
键        msqid      拥有者  权限     已用字节数 消息      

------------ 共享内存段 --------------
键        shmid      拥有者  权限     字节     连接数  状态      
0x00000000 98304      cky        600        16777216   2                       
0x00000000 4292609    cky        600        1048576    2          目标       
0x00000000 524290     cky        600        67108864   2          目标       
0x00000000 983043     cky        600        524288     2          目标       
0x00000000 753668     cky        600        524288     2          目标       
0x00000000 4096005    cky        600        524288     2          目标       
0x00000000 4423686    cky        700        782768     2          目标       
0x00000000 3440651    cky        600        524288     2          目标       
0x00000000 2293773    cky        600        1048576    2          目标       

--------- 信号量数组 -----------
键        semid      拥有者  权限     nsems     
```

# 开启启动服务
- 标准启动运行级别 3
- 开心图形化界面的运行级别 5
- ubuntu 开机启动脚本在 /etc/rcX.d/目录下， X 是运行级别, 标准Linux 在 /etc/inittab 文件中
```
➜  ~ ls -alh /etc/rc5.d
总用量 16K
drwxr-xr-x   2 root root 4.0K 5月  28 15:38 .
drwxr-xr-x 147 root root  12K 6月  12 17:07 ..
lrwxrwxrwx   1 root root   15 1月  14 23:39 S01acpid -> ../init.d/acpid
lrwxrwxrwx   1 root root   17 1月  14 23:39 S01anacron -> ../init.d/anacron
lrwxrwxrwx   1 root root   16 1月  14 23:39 S01apport -> ../init.d/apport
lrwxrwxrwx   1 root root   22 1月  14 23:39 S01avahi-daemon -> ../init.d/avahi-daemon
lrwxrwxrwx   1 root root   24 5月   2 18:45 S01binfmt-support -> ../init.d/binfmt-support
lrwxrwxrwx   1 root root   19 1月  14 23:39 S01bluetooth -> ../init.d/bluetooth
lrwxrwxrwx   1 root root   19 1月  14 23:39 S01cgmanager -> ../init.d/cgmanager
lrwxrwxrwx   1 root root   17 1月  14 23:39 S01cgproxy -> ../init.d/cgproxy
lrwxrwxrwx   1 root root   26 1月  14 23:39 S01console-setup.sh -> ../init.d/console-setup.sh
lrwxrwxrwx   1 root root   14 1月  14 23:39 S01cron -> ../init.d/cron
lrwxrwxrwx   1 root root   14 1月  14 23:39 S01cups -> ../init.d/cups
lrwxrwxrwx   1 root root   22 1月  14 23:39 S01cups-browsed -> ../init.d/cups-browsed
lrwxrwxrwx   1 root root   14 1月  14 23:39 S01dbus -> ../init.d/dbus
lrwxrwxrwx   1 root root   15 4月  28 17:15 S01exim4 -> ../init.d/exim4
lrwxrwxrwx   1 root root   21 1月  14 23:39 S01grub-common -> ../init.d/grub-common
lrwxrwxrwx   1 root root   20 1月  14 23:39 S01irqbalance -> ../init.d/irqbalance
lrwxrwxrwx   1 root root   20 1月  14 23:39 S01kerneloops -> ../init.d/kerneloops
lrwxrwxrwx   1 root root   17 1月  14 23:39 S01lightdm -> ../init.d/lightdm
lrwxrwxrwx   1 root root   17 1月  14 23:39 S01openvpn -> ../init.d/openvpn
lrwxrwxrwx   1 root root   18 1月  14 23:39 S01plymouth -> ../init.d/plymouth
lrwxrwxrwx   1 root root   15 1月  14 23:39 S01rsync -> ../init.d/rsync
lrwxrwxrwx   1 root root   17 1月  14 23:39 S01rsyslog -> ../init.d/rsyslog
lrwxrwxrwx   1 root root   15 1月  14 23:39 S01saned -> ../init.d/saned
lrwxrwxrwx   1 root root   27 1月  14 23:39 S01speech-dispatcher -> ../init.d/speech-dispatcher
lrwxrwxrwx   1 root root   18 1月  14 23:39 S01thermald -> ../init.d/thermald
lrwxrwxrwx   1 root root   29 5月  28 15:38 S01unattended-upgrades -> ../init.d/unattended-upgrades
lrwxrwxrwx   1 root root   15 1月  14 23:39 S01uuidd -> ../init.d/uuidd
lrwxrwxrwx   1 root root   15 4月  28 17:15 S01webfs -> ../init.d/webfs
lrwxrwxrwx   1 root root   18 1月  14 23:39 S01whoopsie -> ../init.d/whoopsie
```

# 查看系统正在运行的所有进程
```
➜  ~ ps aux  显示了系统所有进程
USER       PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
root         1  0.0  0.0 205172  7472 ?        Ss   6月11   0:03 /sbin/init splash
root         2  0.0  0.0      0     0 ?        S    6月11   0:00 [kthreadd]
root         4  0.0  0.0      0     0 ?        S<   6月11   0:00 [kworker/0:0H]
root         6  0.0  0.0      0     0 ?        S    6月11   0:00 [ksoftirqd/0]
root         7  0.0  0.0      0     0 ?        S    6月11   0:48 [rcu_sched]
root         8  0.0  0.0      0     0 ?        S    6月11   0:00 [rcu_bh]
root         9  0.0  0.0      0     0 ?        S    6月11   0:00 [migration/0]
root        10  0.0  0.0      0     0 ?        S<   6月11   0:00 [lru-add-drain]

➜  md git:(master) ✗ ps axjf  显示了进程 子进程之间关系
1256  2414  2414  2414 ?           -1 Ssl   1000   0:00  \_ /usr/lib/zeitgeist/zeitgeist/zeitgeist-fts
1256  3104  3104  3104 ?           -1 Ssl   1000   1:25  \_ /usr/lib/gnome-terminal/gnome-terminal-server
3104 19021 19021 19021 pts/0    28998 Ss    1000   0:01  |   \_ -zsh
19021 28998 28998 19021 pts/0    28998 R+    1000   0:00  |       \_ ps axjf
1256  4978  4978  4978 ?           -1 Ssl   1000   0:00  \_ /usr/lib/gvfs/gvfsd-metadata
1256  9973  1264  1264 ?           -1 Sl    1000   0:00  \_ /usr/lib/x86_64-linux-gnu/unity-scope-home/unity-scope-home
1256  9984  1264  1264 ?           -1 Sl    1000   0:02  \_ /usr/bin/unity-scope-loader applications/applications.scope applications/scopes.scope commands.scope
1256  9986  1264  1264 ?           -1 Sl    1000   0:00  \_ /usr/lib/x86_64-linux-gnu/unity-lens-files/unity-files-daemon
1256 27261  1879  1879 ?           -1 Sl    1000   0:00  \_ /usr/lib/gvfs/gvfsd-http --spawner :1.34 /org/gtk/gvfs/exec_spaw/1
1256 27452  1922  1922 ?           -1 Sl    1000   0:34  \_ /usr/share/atom/atom
27452 27456  1922  1922 ?           -1 S     1000   0:00      \_ /usr/share/atom/atom --type=zygote --no-sandbox
27456 27486  1922  1922 ?           -1 Sl    1000   1:53      |   \_ /usr/share/atom/atom --type=renderer --no-sandbox --primordial-pipe-token=5FB08F41890303548B2FA33DC5BC037D --lang=zh-CN --no
27486 27532  1922  1922 ?           -1 Sl    1000   0:01      |       \_ /usr/share/atom/atom --eval require('/usr/share/atom/resources/app.asar/src/compile-cache.js').setCacheDirectory('/home/
27452 27477  1922  1922 ?           -1 Sl    1000   0:15      \_ /usr/share/atom/atom --type=gpu-process --channel=27452.0.402898927 --mojo-application-channel-token=EFAAB32038ECC938F83A4C0C4C5
   1  1367  1366  1366 ?           -1 Sl    1000   0:33 /usr/bin/fcitx


➜  md git:(master) ✗ ps lax   长模式 ，显示了 PPID 谦让值 NI 进程正在等待的资源
F   UID   PID  PPID PRI  NI    VSZ   RSS WCHAN  STAT TTY        TIME COMMAND
4     0     1     0  20   0 205172  7472 -      Ss   ?          0:03 /sbin/init splash
1     0     2     0  20   0      0     0 -      S    ?          0:00 [kthreadd]
1     0     4     2   0 -20      0     0 -      S<   ?          0:00 [kworker/0:0H]
1     0     6     2  20   0      0     0 -      S    ?          0:00 [ksoftirqd/0]
1     0     7     2  20   0      0     0 -      S    ?          0:49 [rcu_sched]
1     0     8     2  20   0      0     0 -      S    ?          0:00 [rcu_bh]
1     0     9     2 -100  -      0     0 -      S    ?          0:00 [migration/0]
1     0    10     2   0 -20      0     0 -      S<   ?          0:00 [lru-add-drain]
5     0    11     2 -100  -      0     0 -      S    ?          0:00 [watchdog/0]
1     0    12     2  20   0      0     0 -      S    ?          0:00 [cpuhp/0]
```

# 硬件设备管理
- 字符型设备文件，调制解调器，终端
- 块设备文件,硬盘
- 网络设备文件,采用数据包发送和接受数据的设备，比如各种网卡和特殊的回环设备
```
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
crw--w---- 1 root tty     4, 10 6月  11 14:09 tty10
crw--w---- 1 root tty     4, 11 6月  11 14:09 tty11
crw--w---- 1 root tty     4, 12 6月  11 14:09 tty12
crw--w---- 1 root tty     4, 13 6月  11 14:09 tty13
crw--w---- 1 root tty     4, 14 6月  11 14:09 tty14
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
```
➜  ~ cd /lib/terminfo/v
➜  v ls
vt100  vt102  vt220  vt52
➜  v infocmp vt100  列出终端定义的功能，以及用来模拟每个功能的控制码
#	Reconstructed via infocmp from file: /lib/terminfo/v/vt100
vt100|vt100-am|dec vt100 (w/advanced video),
	am, mc5i, msgr, xenl, xon,
	cols#80, it#8, lines#24, vt#3,
	acsc=``aaffggjjkkllmmnnooppqqrrssttuuvvwwxxyyzz{{||}}~~,
	bel=^G, blink=\E[5m$<2>, bold=\E[1m$<2>,
	clear=\E[H\E[J$<50>, cr=^M, csr=\E[%i%p1%d;%p2%dr,
	cub=\E[%p1%dD, cub1=^H, cud=\E[%p1%dB, cud1=^J,
	cuf=\E[%p1%dC, cuf1=\E[C$<2>,
	cup=\E[%i%p1%d;%p2%dH$<5>, cuu=\E[%p1%dA,
	cuu1=\E[A$<2>, ed=\E[J$<50>, el=\E[K$<3>, el1=\E[1K$<3>,
	enacs=\E(B\E)0, home=\E[H, ht=^I, hts=\EH, ind=^J, ka1=\EOq,
	ka3=\EOs, kb2=\EOr, kbs=^H, kc1=\EOp, kc3=\EOn, kcub1=\EOD,
	kcud1=\EOB, kcuf1=\EOC, kcuu1=\EOA, kent=\EOM, kf0=\EOy,
	kf1=\EOP, kf10=\EOx, kf2=\EOQ, kf3=\EOR, kf4=\EOS, kf5=\EOt,
	kf6=\EOu, kf7=\EOv, kf8=\EOl, kf9=\EOw, lf1=pf1, lf2=pf2,
	lf3=pf3, lf4=pf4, mc0=\E[0i, mc4=\E[4i, mc5=\E[5i, rc=\E8,
	rev=\E[7m$<2>, ri=\EM$<5>, rmacs=^O, rmam=\E[?7l,
	rmkx=\E[?1l\E>, rmso=\E[m$<2>, rmul=\E[m$<2>,
	rs2=\E>\E[?3l\E[?4l\E[?5l\E[?7h\E[?8h, sc=\E7,
	sgr=\E[0%?%p1%p6%|%t;1%;%?%p2%t;4%;%?%p1%p3%|%t;7%;%?%p4%t;5%;m%?%p9%t\016%e\017%;$<2>,
	sgr0=\E[m\017$<2>, smacs=^N, smam=\E[?7h, smkx=\E[?1h\E=,
	smso=\E[7m$<2>, smul=\E[4m$<2>, tbc=\E[3g,
```
- 查看shell会话使用哪个终端模拟设置
```
➜  v echo $TERM
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
fpu_exception	: yes
cpuid level	: 13
wp		: yes
flags		: fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx rdtscp lm constant_tsc arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic popcnt tsc_deadline_timer xsave avx f16c rdrand lahf_lm epb tpr_shadow vnmi flexpriority ept vpid fsgsbase smep erms xsaveopt dtherm ida arat pln pts
bugs		:
bogomips	: 4988.74
clflush size	: 64
cache_alignment	: 64
address sizes	: 36 bits physical, 48 bits virtual
power management:

processor	: 1
vendor_id	: GenuineIntel
cpu family	: 6
model		: 58
model name	: Intel(R) Core(TM) i5-3210M CPU @ 2.50GHz
stepping	: 9
microcode	: 0x1c
cpu MHz		: 1201.629
cache size	: 3072 KB
physical id	: 0
siblings	: 4
core id		: 1
cpu cores	: 2
apicid		: 2
initial apicid	: 2
fpu		: yes
fpu_exception	: yes
cpuid level	: 13
wp		: yes
flags		: fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx rdtscp lm constant_tsc arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic popcnt tsc_deadline_timer xsave avx f16c rdrand lahf_lm epb tpr_shadow vnmi flexpriority ept vpid fsgsbase smep erms xsaveopt dtherm ida arat pln pts
bugs		:
bogomips	: 4988.74
clflush size	: 64
cache_alignment	: 64
address sizes	: 36 bits physical, 48 bits virtual
power management:

processor	: 2
vendor_id	: GenuineIntel
cpu family	: 6
model		: 58
model name	: Intel(R) Core(TM) i5-3210M CPU @ 2.50GHz
stepping	: 9
microcode	: 0x1c
cpu MHz		: 1206.512
cache size	: 3072 KB
physical id	: 0
siblings	: 4
core id		: 0
cpu cores	: 2
apicid		: 1
initial apicid	: 1
fpu		: yes
fpu_exception	: yes
cpuid level	: 13
wp		: yes
flags		: fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx rdtscp lm constant_tsc arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic popcnt tsc_deadline_timer xsave avx f16c rdrand lahf_lm epb tpr_shadow vnmi flexpriority ept vpid fsgsbase smep erms xsaveopt dtherm ida arat pln pts
bugs		:
bogomips	: 4988.74
clflush size	: 64
cache_alignment	: 64
address sizes	: 36 bits physical, 48 bits virtual
power management:

processor	: 3
vendor_id	: GenuineIntel
cpu family	: 6
model		: 58
model name	: Intel(R) Core(TM) i5-3210M CPU @ 2.50GHz
stepping	: 9
microcode	: 0x1c
cpu MHz		: 1201.019
cache size	: 3072 KB
physical id	: 0
siblings	: 4
core id		: 1
cpu cores	: 2
apicid		: 3
initial apicid	: 3
fpu		: yes
fpu_exception	: yes
cpuid level	: 13
wp		: yes
flags		: fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx rdtscp lm constant_tsc arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic popcnt tsc_deadline_timer xsave avx f16c rdrand lahf_lm epb tpr_shadow vnmi flexpriority ept vpid fsgsbase smep erms xsaveopt dtherm ida arat pln pts
bugs		:
bogomips	: 4988.74
clflush size	: 64
cache_alignment	: 64
address sizes	: 36 bits physical, 48 bits virtual
power management:
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
systemd       1 root NOFD                                /proc/1/fd (opendir: Permission denied)
kthreadd      2 root  cwd   unknown                      /proc/2/cwd (readlink: Permission denied)
kthreadd      2 root  rtd   unknown                      /proc/2/root (readlink: Permission denied)
kthreadd      2 root  txt   unknown                      /proc/2/exe (readlink: Permission denied)
kthreadd      2 root NOFD                                /proc/2/fd (opendir: Permission denied)
kworker/0     4 root  cwd   unknown                      /proc/4/cwd (readlink: Permission denied)
kworker/0     4 root  rtd   unknown                      /proc/4/root (readlink: Permission denied)
kworker/0     4 root  txt   unknown                      /proc/4/exe (readlink: Permission denied)
kworker/0     4 root NOFD                                /proc/4/fd (opendir: Permission denied)
ksoftirqd     6 root  cwd   unknown                      /proc/6/cwd (readlink: Permission denied)
ksoftirqd     6 root  rtd   unknown                      /proc/6/root (readlink: Permission denied)
ksoftirqd     6 root  txt   unknown                      /proc/6/exe (readlink: Permission denied)
ksoftirqd     6 root NOFD                                /proc/6/fd (opendir: Permission denied)
rcu_sched     7 root  cwd   unknown                      /proc/7/cwd (readlink: Permission denied)
rcu_sched     7 root  rtd   unknown                      /proc/7/root (readlink: Permission denied)
rcu_sched     7 root  txt   unknown                      /proc/7/exe (readlink: Permission denied)
rcu_sched     7 root NOFD                                /proc/7/fd (opendir: Permission denied)
rcu_bh        8 root  cwd   unknown                      /proc/8/cwd (readlink: Permission denied)
rcu_bh        8 root  rtd   unknown                      /proc/8/root (readlink: Permission denied)
rcu_bh        8 root  txt   unknown                      /proc/8/exe (readlink: Permission denied)
rcu_bh        8 root NOFD                                /proc/8/fd (opendir: Permission denied)
migration     9 root  cwd   unknown                      /proc/9/cwd (readlink: Permission denied)
migration     9 root  rtd   unknown                      /proc/9/root (readlink: Permission denied)
migration     9 root  txt   unknown                      /proc/9/exe (readlink: Permission denied)
migration     9 root NOFD                                /proc/9/fd (opendir: Permission denied)
...
```


dmesg 内核启动自检信息
================================================================================
```bash
cky@cky-pc:~$ dmesg
[    0.000000] microcode: microcode updated early to revision 0x1c, date = 2015-02-26
[    0.000000] Linux version 4.10.0-22-generic (buildd@lcy01-08) (gcc version 6.3.0 20170406 (Ubuntu 6.3.0-12ubuntu2) ) #24-Ubuntu SMP Mon May 22 17:43:20 UTC 2017 (Ubuntu 4.10.0-22.24-generic 4.10.15)
[    0.000000] Command line: BOOT_IMAGE=/boot/vmlinuz-4.10.0-22-generic.efi.signed root=UUID=c695fce2-23e1-40e0-b3df-f65bdd56d677 ro quiet splash vt.handoff=7
[    0.000000] KERNEL supported cpus:
[    0.000000]   Intel GenuineIntel
[    0.000000]   AMD AuthenticAMD
[    0.000000]   Centaur CentaurHauls
[    0.000000] x86/fpu: Supporting XSAVE feature 0x001: 'x87 floating point registers'
[    0.000000] x86/fpu: Supporting XSAVE feature 0x002: 'SSE registers'
[    0.000000] x86/fpu: Supporting XSAVE feature 0x004: 'AVX registers'
[    0.000000] x86/fpu: xstate_offset[2]:  576, xstate_sizes[2]:  256
[    0.000000] x86/fpu: Enabled xstate features 0x7, context size is 832 bytes, using 'standard' format.
[    0.000000] e820: BIOS-provided physical RAM map:
[    0.000000] BIOS-e820: [mem 0x0000000000000000-0x000000000009efff] usable
[    0.000000] BIOS-e820: [mem 0x000000000009f000-0x000000000009ffff] reserved
[    0.000000] BIOS-e820: [mem 0x0000000000100000-0x000000001fffffff] usable
[    0.000000] BIOS-e820: [mem 0x0000000020000000-0x00000000201fffff] reserved
[    0.000000] BIOS-e820: [mem 0x0000000020200000-0x0000000040003fff] usable
[    0.000000] BIOS-e820: [mem 0x0000000040004000-0x0000000040004fff] reserved
[    0.000000] BIOS-e820: [mem 0x0000000040005000-0x00000000c9753fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9754000-0x00000000c9d54fff] ACPI NVS
[    0.000000] BIOS-e820: [mem 0x00000000c9d55000-0x00000000c9d57fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9d58000-0x00000000c9d6efff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9d6f000-0x00000000c9d74fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9d75000-0x00000000c9d76fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9d77000-0x00000000c9d84fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9d85000-0x00000000c9f16fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9f17000-0x00000000c9f1afff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9f1b000-0x00000000c9f63fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9f64000-0x00000000c9f6afff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9f6b000-0x00000000c9f77fff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000c9f78000-0x00000000c9f88fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9f89000-0x00000000c9f8bfff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9f8c000-0x00000000c9f8dfff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9f8e000-0x00000000c9fa4fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9fa5000-0x00000000c9faafff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9fab000-0x00000000c9fb2fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9fb3000-0x00000000c9fb3fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9fb4000-0x00000000c9fc2fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9fc3000-0x00000000c9fc3fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9fc4000-0x00000000c9fcefff] usable
[    0.000000] BIOS-e820: [mem 0x00000000c9fcf000-0x00000000c9fd3fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000c9fd4000-0x00000000c9ffffff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca000000-0x00000000ca000fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000ca001000-0x00000000ca010fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca011000-0x00000000ca037fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000ca038000-0x00000000ca04afff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca04b000-0x00000000ca04bfff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000ca04c000-0x00000000ca04cfff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca04d000-0x00000000ca04efff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000ca04f000-0x00000000ca04ffff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca050000-0x00000000ca054fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000ca055000-0x00000000ca06afff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca06b000-0x00000000ca0cafff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000ca0cb000-0x00000000ca0e3fff] type 20
[    0.000000] BIOS-e820: [mem 0x00000000ca0e4000-0x00000000ca60dfff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000ca60e000-0x00000000ca88dfff] ACPI NVS
[    0.000000] BIOS-e820: [mem 0x00000000ca88e000-0x00000000ca892fff] ACPI data
[    0.000000] BIOS-e820: [mem 0x00000000ca893000-0x00000000ca893fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000ca894000-0x00000000ca8d6fff] ACPI NVS
[    0.000000] BIOS-e820: [mem 0x00000000ca8d7000-0x00000000cace3fff] usable
[    0.000000] BIOS-e820: [mem 0x00000000cace4000-0x00000000caff3fff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000caff4000-0x00000000caffffff] usable
[    0.000000] BIOS-e820: [mem 0x00000000cbc00000-0x00000000cfdfffff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000f8000000-0x00000000fbffffff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000fec00000-0x00000000fec00fff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000fed00000-0x00000000fed03fff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000fed1c000-0x00000000fed1ffff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000fee00000-0x00000000fee00fff] reserved
[    0.000000] BIOS-e820: [mem 0x00000000ff000000-0x00000000ffffffff] reserved
[    0.000000] BIOS-e820: [mem 0x0000000100000000-0x000000022f1fffff] usable
[    0.000000] NX (Execute Disable) protection: active
[    0.000000] efi: EFI v2.31 by American Megatrends
[    0.000000] efi:  ACPI=0xca860000  ACPI 2.0=0xca860000  SMBIOS=0xf04c0  MPS=0xfd4d0 
[    0.000000] SMBIOS 2.7 present.
[    0.000000] DMI: ASUSTeK COMPUTER INC. K55VD/K55VD, BIOS K55VD.404 08/20/2012
[    0.000000] e820: update [mem 0x00000000-0x00000fff] usable ==> reserved
[    0.000000] e820: remove [mem 0x000a0000-0x000fffff] usable
[    0.000000] e820: last_pfn = 0x22f200 max_arch_pfn = 0x400000000
[    0.000000] MTRR default type: uncachable
[    0.000000] MTRR fixed ranges enabled:
[    0.000000]   00000-9FFFF write-back
[    0.000000]   A0000-BFFFF uncachable
[    0.000000]   C0000-CFFFF write-protect
[    0.000000]   D0000-DFFFF uncachable
[    0.000000]   E0000-FFFFF write-protect
[    0.000000] MTRR variable ranges enabled:
[    0.000000]   0 base 000000000 mask E00000000 write-back
[    0.000000]   1 base 200000000 mask FE0000000 write-back
[    0.000000]   2 base 220000000 mask FF0000000 write-back
[    0.000000]   3 base 0E0000000 mask FE0000000 uncachable
[    0.000000]   4 base 0D0000000 mask FF0000000 uncachable
[    0.000000]   5 base 0CC000000 mask FFC000000 uncachable
[    0.000000]   6 base 0CBC00000 mask FFFC00000 uncachable
[    0.000000]   7 base 22F800000 mask FFF800000 uncachable
[    0.000000]   8 base 22F400000 mask FFFC00000 uncachable
[    0.000000]   9 base 22F200000 mask FFFE00000 uncachable
[    0.000000] x86/PAT: Configuration [0-7]: WB  WC  UC- UC  WB  WC  UC- WT  
[    0.000000] total RAM covered: 8110M
[    0.000000]  gran_size: 64K 	chunk_size: 64K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 128K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 256K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 512K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 1M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 2M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 64K 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 32M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 64M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 128M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 256M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: -264M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 1G 	num_reg: 10  	lose cover RAM: -256M
[    0.000000] *BAD*gran_size: 64K 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: -1280M
[    0.000000]  gran_size: 128K 	chunk_size: 128K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 128K 	chunk_size: 256K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 128K 	chunk_size: 512K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 128K 	chunk_size: 1M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 128K 	chunk_size: 2M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 128K 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 128K 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 32M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 64M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 128M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 256M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: -264M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 1G 	num_reg: 10  	lose cover RAM: -256M
[    0.000000] *BAD*gran_size: 128K 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: -1280M
[    0.000000]  gran_size: 256K 	chunk_size: 256K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 256K 	chunk_size: 512K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 256K 	chunk_size: 1M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 256K 	chunk_size: 2M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 256K 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 256K 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 32M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 64M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 128M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 256M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: -264M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 1G 	num_reg: 10  	lose cover RAM: -256M
[    0.000000] *BAD*gran_size: 256K 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: -1280M
[    0.000000]  gran_size: 512K 	chunk_size: 512K 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 512K 	chunk_size: 1M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 512K 	chunk_size: 2M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 512K 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 512K 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 32M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 64M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 128M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 256M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: -264M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 1G 	num_reg: 10  	lose cover RAM: -256M
[    0.000000] *BAD*gran_size: 512K 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: -1280M
[    0.000000]  gran_size: 1M 	chunk_size: 1M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 1M 	chunk_size: 2M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 1M 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 1M 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 32M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 64M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 128M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 256M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: -264M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 1G 	num_reg: 10  	lose cover RAM: -256M
[    0.000000] *BAD*gran_size: 1M 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: -1280M
[    0.000000]  gran_size: 2M 	chunk_size: 2M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 2M 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 2M 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 32M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 64M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 128M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 256M 	num_reg: 10  	lose cover RAM: -8M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: -264M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 1G 	num_reg: 10  	lose cover RAM: -256M
[    0.000000] *BAD*gran_size: 2M 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: -1280M
[    0.000000]  gran_size: 4M 	chunk_size: 4M 	num_reg: 10  	lose cover RAM: 114M
[    0.000000]  gran_size: 4M 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000]  gran_size: 4M 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: 18M
[    0.000000]  gran_size: 4M 	chunk_size: 32M 	num_reg: 9  	lose cover RAM: 2M
[    0.000000]  gran_size: 4M 	chunk_size: 64M 	num_reg: 9  	lose cover RAM: 2M
[    0.000000]  gran_size: 4M 	chunk_size: 128M 	num_reg: 9  	lose cover RAM: 2M
[    0.000000]  gran_size: 4M 	chunk_size: 256M 	num_reg: 9  	lose cover RAM: 2M
[    0.000000]  gran_size: 4M 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: 2M
[    0.000000]  gran_size: 4M 	chunk_size: 1G 	num_reg: 9  	lose cover RAM: 2M
[    0.000000]  gran_size: 4M 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: 2M
[    0.000000]  gran_size: 8M 	chunk_size: 8M 	num_reg: 10  	lose cover RAM: 54M
[    0.000000]  gran_size: 8M 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: 22M
[    0.000000]  gran_size: 8M 	chunk_size: 32M 	num_reg: 9  	lose cover RAM: 6M
[    0.000000]  gran_size: 8M 	chunk_size: 64M 	num_reg: 9  	lose cover RAM: 6M
[    0.000000]  gran_size: 8M 	chunk_size: 128M 	num_reg: 9  	lose cover RAM: 6M
[    0.000000]  gran_size: 8M 	chunk_size: 256M 	num_reg: 9  	lose cover RAM: 6M
[    0.000000]  gran_size: 8M 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: 6M
[    0.000000]  gran_size: 8M 	chunk_size: 1G 	num_reg: 9  	lose cover RAM: 6M
[    0.000000]  gran_size: 8M 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: 6M
[    0.000000]  gran_size: 16M 	chunk_size: 16M 	num_reg: 10  	lose cover RAM: 30M
[    0.000000]  gran_size: 16M 	chunk_size: 32M 	num_reg: 9  	lose cover RAM: 14M
[    0.000000]  gran_size: 16M 	chunk_size: 64M 	num_reg: 9  	lose cover RAM: 14M
[    0.000000]  gran_size: 16M 	chunk_size: 128M 	num_reg: 9  	lose cover RAM: 14M
[    0.000000]  gran_size: 16M 	chunk_size: 256M 	num_reg: 9  	lose cover RAM: 14M
[    0.000000]  gran_size: 16M 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: 14M
[    0.000000]  gran_size: 16M 	chunk_size: 1G 	num_reg: 9  	lose cover RAM: 14M
[    0.000000]  gran_size: 16M 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: 14M
[    0.000000]  gran_size: 32M 	chunk_size: 32M 	num_reg: 9  	lose cover RAM: 46M
[    0.000000]  gran_size: 32M 	chunk_size: 64M 	num_reg: 9  	lose cover RAM: 46M
[    0.000000]  gran_size: 32M 	chunk_size: 128M 	num_reg: 9  	lose cover RAM: 46M
[    0.000000]  gran_size: 32M 	chunk_size: 256M 	num_reg: 9  	lose cover RAM: 46M
[    0.000000]  gran_size: 32M 	chunk_size: 512M 	num_reg: 10  	lose cover RAM: 46M
[    0.000000]  gran_size: 32M 	chunk_size: 1G 	num_reg: 9  	lose cover RAM: 46M
[    0.000000]  gran_size: 32M 	chunk_size: 2G 	num_reg: 10  	lose cover RAM: 46M
[    0.000000]  gran_size: 64M 	chunk_size: 64M 	num_reg: 7  	lose cover RAM: 110M
[    0.000000]  gran_size: 64M 	chunk_size: 128M 	num_reg: 7  	lose cover RAM: 110M
[    0.000000]  gran_size: 64M 	chunk_size: 256M 	num_reg: 8  	lose cover RAM: 110M
[    0.000000]  gran_size: 64M 	chunk_size: 512M 	num_reg: 9  	lose cover RAM: 110M
[    0.000000]  gran_size: 64M 	chunk_size: 1G 	num_reg: 8  	lose cover RAM: 110M
[    0.000000]  gran_size: 64M 	chunk_size: 2G 	num_reg: 9  	lose cover RAM: 110M
[    0.000000]  gran_size: 128M 	chunk_size: 128M 	num_reg: 6  	lose cover RAM: 174M
[    0.000000]  gran_size: 128M 	chunk_size: 256M 	num_reg: 8  	lose cover RAM: 174M
[    0.000000]  gran_size: 128M 	chunk_size: 512M 	num_reg: 9  	lose cover RAM: 174M
[    0.000000]  gran_size: 128M 	chunk_size: 1G 	num_reg: 8  	lose cover RAM: 174M
[    0.000000]  gran_size: 128M 	chunk_size: 2G 	num_reg: 9  	lose cover RAM: 174M
[    0.000000]  gran_size: 256M 	chunk_size: 256M 	num_reg: 4  	lose cover RAM: 430M
[    0.000000]  gran_size: 256M 	chunk_size: 512M 	num_reg: 4  	lose cover RAM: 430M
[    0.000000]  gran_size: 256M 	chunk_size: 1G 	num_reg: 5  	lose cover RAM: 430M
[    0.000000]  gran_size: 256M 	chunk_size: 2G 	num_reg: 6  	lose cover RAM: 430M
[    0.000000]  gran_size: 512M 	chunk_size: 512M 	num_reg: 4  	lose cover RAM: 430M
[    0.000000]  gran_size: 512M 	chunk_size: 1G 	num_reg: 5  	lose cover RAM: 430M
[    0.000000]  gran_size: 512M 	chunk_size: 2G 	num_reg: 6  	lose cover RAM: 430M
[    0.000000]  gran_size: 1G 	chunk_size: 1G 	num_reg: 3  	lose cover RAM: 942M
[    0.000000]  gran_size: 1G 	chunk_size: 2G 	num_reg: 3  	lose cover RAM: 942M
[    0.000000]  gran_size: 2G 	chunk_size: 2G 	num_reg: 2  	lose cover RAM: 1966M
[    0.000000] mtrr_cleanup: can not find optimal value
[    0.000000] please specify mtrr_gran_size/mtrr_chunk_size
[    0.000000] e820: update [mem 0xcbc00000-0xffffffff] usable ==> reserved
[    0.000000] e820: last_pfn = 0xcb000 max_arch_pfn = 0x400000000
[    0.000000] found SMP MP-table at [mem 0x000fd7f0-0x000fd7ff] mapped at [ffff9148c00fd7f0]
[    0.000000] Scanning 1 areas for low memory corruption
[    0.000000] Base memory trampoline at [ffff9148c0097000] 97000 size 24576
[    0.000000] BRK [0x1c9028000, 0x1c9028fff] PGTABLE
[    0.000000] BRK [0x1c9029000, 0x1c9029fff] PGTABLE
[    0.000000] BRK [0x1c902a000, 0x1c902afff] PGTABLE
[    0.000000] BRK [0x1c902b000, 0x1c902bfff] PGTABLE
[    0.000000] BRK [0x1c902c000, 0x1c902cfff] PGTABLE
[    0.000000] BRK [0x1c902d000, 0x1c902dfff] PGTABLE
[    0.000000] BRK [0x1c902e000, 0x1c902efff] PGTABLE
[    0.000000] BRK [0x1c902f000, 0x1c902ffff] PGTABLE
[    0.000000] BRK [0x1c9030000, 0x1c9030fff] PGTABLE
[    0.000000] BRK [0x1c9031000, 0x1c9031fff] PGTABLE
[    0.000000] BRK [0x1c9032000, 0x1c9032fff] PGTABLE
[    0.000000] BRK [0x1c9033000, 0x1c9033fff] PGTABLE
[    0.000000] RAMDISK: [mem 0x32f67000-0x357aafff]
[    0.000000] ACPI: Early table checksum verification disabled
[    0.000000] ACPI: RSDP 0x00000000CA860000 000024 (v02 _ASUS_)
[    0.000000] ACPI: XSDT 0x00000000CA860078 000074 (v01 _ASUS_ Notebook 01072009 AMI  00010013)
[    0.000000] ACPI: FACP 0x00000000CA873148 00010C (v05 _ASUS_ Notebook 01072009 AMI  00010013)
[    0.000000] ACPI: DSDT 0x00000000CA860188 012FB9 (v02 _ASUS_ Notebook 00000013 INTL 20091112)
[    0.000000] ACPI: FACS 0x00000000CA88B080 000040
[    0.000000] ACPI: APIC 0x00000000CA873258 000072 (v03 _ASUS_ Notebook 01072009 AMI  00010013)
[    0.000000] ACPI: FPDT 0x00000000CA8732D0 000044 (v01 _ASUS_ Notebook 01072009 AMI  00010013)
[    0.000000] ACPI: ECDT 0x00000000CA873318 0000C1 (v01 _ASUS_ Notebook 01072009 AMI. 00000005)
[    0.000000] ACPI: MCFG 0x00000000CA8733E0 00003C (v01 _ASUS_ Notebook 01072009 MSFT 00000097)
[    0.000000] ACPI: HPET 0x00000000CA873420 000038 (v01 _ASUS_ Notebook 01072009 AMI. 00000005)
[    0.000000] ACPI: SSDT 0x00000000CA873458 000632 (v01 AhciR1 AhciTab1 00001000 INTL 20091112)
[    0.000000] ACPI: SSDT 0x00000000CA873A90 00049E (v01 AhciR2 AhciTab2 00001000 INTL 20091112)
[    0.000000] ACPI: SSDT 0x00000000CA873F30 00098E (v01 PmRef  Cpu0Ist  00003000 INTL 20051117)
[    0.000000] ACPI: SSDT 0x00000000CA8748C0 000A92 (v01 PmRef  CpuPm    00003000 INTL 20051117)
[    0.000000] ACPI: Local APIC address 0xfee00000
[    0.000000] No NUMA configuration found
[    0.000000] Faking a node at [mem 0x0000000000000000-0x000000022f1fffff]
[    0.000000] NODE_DATA(0) allocated [mem 0x22f1cd000-0x22f1f7fff]
[    0.000000] Zone ranges:
[    0.000000]   DMA      [mem 0x0000000000001000-0x0000000000ffffff]
[    0.000000]   DMA32    [mem 0x0000000001000000-0x00000000ffffffff]
[    0.000000]   Normal   [mem 0x0000000100000000-0x000000022f1fffff]
[    0.000000]   Device   empty
[    0.000000] Movable zone start for each node
[    0.000000] Early memory node ranges
[    0.000000]   node   0: [mem 0x0000000000001000-0x000000000009efff]
[    0.000000]   node   0: [mem 0x0000000000100000-0x000000001fffffff]
[    0.000000]   node   0: [mem 0x0000000020200000-0x0000000040003fff]
[    0.000000]   node   0: [mem 0x0000000040005000-0x00000000c9753fff]
[    0.000000]   node   0: [mem 0x00000000c9d58000-0x00000000c9d6efff]
[    0.000000]   node   0: [mem 0x00000000c9d75000-0x00000000c9d76fff]
[    0.000000]   node   0: [mem 0x00000000c9d85000-0x00000000c9f16fff]
[    0.000000]   node   0: [mem 0x00000000c9f1b000-0x00000000c9f63fff]
[    0.000000]   node   0: [mem 0x00000000c9f89000-0x00000000c9f8bfff]
[    0.000000]   node   0: [mem 0x00000000c9f8e000-0x00000000c9fa4fff]
[    0.000000]   node   0: [mem 0x00000000c9fab000-0x00000000c9fb2fff]
[    0.000000]   node   0: [mem 0x00000000c9fb4000-0x00000000c9fc2fff]
[    0.000000]   node   0: [mem 0x00000000c9fc4000-0x00000000c9fcefff]
[    0.000000]   node   0: [mem 0x00000000c9fd4000-0x00000000c9ffffff]
[    0.000000]   node   0: [mem 0x00000000ca001000-0x00000000ca010fff]
[    0.000000]   node   0: [mem 0x00000000ca038000-0x00000000ca04afff]
[    0.000000]   node   0: [mem 0x00000000ca04c000-0x00000000ca04cfff]
[    0.000000]   node   0: [mem 0x00000000ca04f000-0x00000000ca04ffff]
[    0.000000]   node   0: [mem 0x00000000ca055000-0x00000000ca06afff]
[    0.000000]   node   0: [mem 0x00000000ca893000-0x00000000ca893fff]
[    0.000000]   node   0: [mem 0x00000000ca8d7000-0x00000000cace3fff]
[    0.000000]   node   0: [mem 0x00000000caff4000-0x00000000caffffff]
[    0.000000]   node   0: [mem 0x0000000100000000-0x000000022f1fffff]
[    0.000000] Initmem setup node 0 [mem 0x0000000000001000-0x000000022f1fffff]
[    0.000000] On node 0 totalpages: 2067874
[    0.000000]   DMA zone: 64 pages used for memmap
[    0.000000]   DMA zone: 27 pages reserved
[    0.000000]   DMA zone: 3998 pages, LIFO batch:0
[    0.000000]   DMA32 zone: 12849 pages used for memmap
[    0.000000]   DMA32 zone: 822276 pages, LIFO batch:31
[    0.000000]   Normal zone: 19400 pages used for memmap
[    0.000000]   Normal zone: 1241600 pages, LIFO batch:31
[    0.000000] Reserving Intel graphics memory at 0x00000000cbe00000-0x00000000cfdfffff
[    0.000000] ACPI: PM-Timer IO Port: 0x408
[    0.000000] ACPI: Local APIC address 0xfee00000
[    0.000000] ACPI: LAPIC_NMI (acpi_id[0xff] high edge lint[0x1])
[    0.000000] IOAPIC[0]: apic_id 2, version 32, address 0xfec00000, GSI 0-23
[    0.000000] ACPI: INT_SRC_OVR (bus 0 bus_irq 0 global_irq 2 dfl dfl)
[    0.000000] ACPI: INT_SRC_OVR (bus 0 bus_irq 9 global_irq 9 high level)
[    0.000000] ACPI: IRQ0 used by override.
[    0.000000] ACPI: IRQ9 used by override.
[    0.000000] Using ACPI (MADT) for SMP configuration information
[    0.000000] ACPI: HPET id: 0x8086a701 base: 0xfed00000
[    0.000000] smpboot: Allowing 4 CPUs, 0 hotplug CPUs
[    0.000000] PM: Registered nosave memory: [mem 0x00000000-0x00000fff]
[    0.000000] PM: Registered nosave memory: [mem 0x0009f000-0x0009ffff]
[    0.000000] PM: Registered nosave memory: [mem 0x000a0000-0x000fffff]
[    0.000000] PM: Registered nosave memory: [mem 0x20000000-0x201fffff]
[    0.000000] PM: Registered nosave memory: [mem 0x40004000-0x40004fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9754000-0xc9d54fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9d55000-0xc9d57fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9d6f000-0xc9d74fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9d77000-0xc9d84fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9f17000-0xc9f1afff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9f64000-0xc9f6afff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9f6b000-0xc9f77fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9f78000-0xc9f88fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9f8c000-0xc9f8dfff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9fa5000-0xc9faafff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9fb3000-0xc9fb3fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9fc3000-0xc9fc3fff]
[    0.000000] PM: Registered nosave memory: [mem 0xc9fcf000-0xc9fd3fff]
[    0.000000] PM: Registered nosave memory: [mem 0xca000000-0xca000fff]
[    0.000000] PM: Registered nosave memory: [mem 0xca011000-0xca037fff]
[    0.000000] PM: Registered nosave memory: [mem 0xca04b000-0xca04bfff]
[    0.000000] PM: Registered nosave memory: [mem 0xca04d000-0xca04efff]
[    0.000000] PM: Registered nosave memory: [mem 0xca050000-0xca054fff]
[    0.000000] PM: Registered nosave memory: [mem 0xca06b000-0xca0cafff]
[    0.000000] PM: Registered nosave memory: [mem 0xca0cb000-0xca0e3fff]
[    0.000000] PM: Registered nosave memory: [mem 0xca0e4000-0xca60dfff]
[    0.000000] PM: Registered nosave memory: [mem 0xca60e000-0xca88dfff]
[    0.000000] PM: Registered nosave memory: [mem 0xca88e000-0xca892fff]
[    0.000000] PM: Registered nosave memory: [mem 0xca894000-0xca8d6fff]
[    0.000000] PM: Registered nosave memory: [mem 0xcace4000-0xcaff3fff]
[    0.000000] PM: Registered nosave memory: [mem 0xcb000000-0xcbbfffff]
[    0.000000] PM: Registered nosave memory: [mem 0xcbc00000-0xcfdfffff]
[    0.000000] PM: Registered nosave memory: [mem 0xcfe00000-0xf7ffffff]
[    0.000000] PM: Registered nosave memory: [mem 0xf8000000-0xfbffffff]
[    0.000000] PM: Registered nosave memory: [mem 0xfc000000-0xfebfffff]
[    0.000000] PM: Registered nosave memory: [mem 0xfec00000-0xfec00fff]
[    0.000000] PM: Registered nosave memory: [mem 0xfec01000-0xfecfffff]
[    0.000000] PM: Registered nosave memory: [mem 0xfed00000-0xfed03fff]
[    0.000000] PM: Registered nosave memory: [mem 0xfed04000-0xfed1bfff]
[    0.000000] PM: Registered nosave memory: [mem 0xfed1c000-0xfed1ffff]
[    0.000000] PM: Registered nosave memory: [mem 0xfed20000-0xfedfffff]
[    0.000000] PM: Registered nosave memory: [mem 0xfee00000-0xfee00fff]
[    0.000000] PM: Registered nosave memory: [mem 0xfee01000-0xfeffffff]
[    0.000000] PM: Registered nosave memory: [mem 0xff000000-0xffffffff]
[    0.000000] e820: [mem 0xcfe00000-0xf7ffffff] available for PCI devices
[    0.000000] Booting paravirtualized kernel on bare hardware
[    0.000000] clocksource: refined-jiffies: mask: 0xffffffff max_cycles: 0xffffffff, max_idle_ns: 7645519600211568 ns
[    0.000000] setup_percpu: NR_CPUS:8192 nr_cpumask_bits:4 nr_cpu_ids:4 nr_node_ids:1
[    0.000000] percpu: Embedded 36 pages/cpu @ffff914aeee00000 s107992 r8192 d31272 u524288
[    0.000000] pcpu-alloc: s107992 r8192 d31272 u524288 alloc=1*2097152
[    0.000000] pcpu-alloc: [0] 0 1 2 3 
[    0.000000] Built 1 zonelists in Node order, mobility grouping on.  Total pages: 2035534
[    0.000000] Policy zone: Normal
[    0.000000] Kernel command line: BOOT_IMAGE=/boot/vmlinuz-4.10.0-22-generic.efi.signed root=UUID=c695fce2-23e1-40e0-b3df-f65bdd56d677 ro quiet splash vt.handoff=7
[    0.000000] PID hash table entries: 4096 (order: 3, 32768 bytes)
[    0.000000] Calgary: detecting Calgary via BIOS EBDA area
[    0.000000] Calgary: Unable to locate Rio Grande table in EBDA - bailing!
[    0.000000] Memory: 7830244K/8271496K available (9082K kernel code, 1666K rwdata, 3816K rodata, 2228K init, 2364K bss, 441252K reserved, 0K cma-reserved)
[    0.000000] SLUB: HWalign=64, Order=0-3, MinObjects=0, CPUs=4, Nodes=1
[    0.000000] Hierarchical RCU implementation.
[    0.000000] 	Build-time adjustment of leaf fanout to 64.
[    0.000000] 	RCU restricting CPUs from NR_CPUS=8192 to nr_cpu_ids=4.
[    0.000000] RCU: Adjusting geometry for rcu_fanout_leaf=64, nr_cpu_ids=4
[    0.000000] NR_IRQS:524544 nr_irqs:456 16
[    0.000000] vt handoff: transparent VT on vt#7
[    0.000000] Console: colour dummy device 80x25
[    0.000000] console [tty0] enabled
[    0.000000] clocksource: hpet: mask: 0xffffffff max_cycles: 0xffffffff, max_idle_ns: 133484882848 ns
[    0.000000] hpet clockevent registered
[    0.000000] tsc: Fast TSC calibration using PIT
[    0.000000] tsc: Detected 2494.371 MHz processor
[    0.000025] Calibrating delay loop (skipped), value calculated using timer frequency.. 4988.74 BogoMIPS (lpj=9977484)
[    0.000027] pid_max: default: 32768 minimum: 301
[    0.000035] ACPI: Core revision 20160930
[    0.012318] ACPI: 5 ACPI AML tables successfully acquired and loaded
[    0.037932] Security Framework initialized
[    0.037933] Yama: becoming mindful.
[    0.037946] AppArmor: AppArmor initialized
[    0.038363] Dentry cache hash table entries: 1048576 (order: 11, 8388608 bytes)
[    0.040301] Inode-cache hash table entries: 524288 (order: 10, 4194304 bytes)
[    0.041193] Mount-cache hash table entries: 16384 (order: 5, 131072 bytes)
[    0.041200] Mountpoint-cache hash table entries: 16384 (order: 5, 131072 bytes)
[    0.041420] CPU: Physical Processor ID: 0
[    0.041421] CPU: Processor Core ID: 0
[    0.041425] ENERGY_PERF_BIAS: Set to 'normal', was 'performance'
[    0.041425] ENERGY_PERF_BIAS: View and update with x86_energy_perf_policy(8)
[    0.041428] mce: CPU supports 7 MCE banks
[    0.041435] CPU0: Thermal monitoring enabled (TM1)
[    0.041444] process: using mwait in idle threads
[    0.041447] Last level iTLB entries: 4KB 512, 2MB 8, 4MB 8
[    0.041448] Last level dTLB entries: 4KB 512, 2MB 32, 4MB 32, 1GB 0
[    0.041565] Freeing SMP alternatives memory: 32K
[    0.048431] ftrace: allocating 34178 entries in 134 pages
[    0.063133] smpboot: Max logical packages: 2
[    0.063209] x2apic: IRQ remapping doesn't support X2APIC mode
[    0.063648] ..TIMER: vector=0x30 apic1=0 pin1=2 apic2=-1 pin2=-1
[    0.103336] TSC deadline timer enabled
[    0.103339] smpboot: CPU0: Intel(R) Core(TM) i5-3210M CPU @ 2.50GHz (family: 0x6, model: 0x3a, stepping: 0x9)
[    0.103387] Performance Events: PEBS fmt1+, IvyBridge events, 16-deep LBR, full-width counters, Intel PMU driver.
[    0.103406] ... version:                3
[    0.103407] ... bit width:              48
[    0.103407] ... generic registers:      4
[    0.103408] ... value mask:             0000ffffffffffff
[    0.103408] ... max period:             00007fffffffffff
[    0.103409] ... fixed-purpose events:   3
[    0.103409] ... event mask:             000000070000000f
[    0.104145] NMI watchdog: enabled on all CPUs, permanently consumes one hw-PMU counter.
[    0.104161] smp: Bringing up secondary CPUs ...
[    0.104228] x86: Booting SMP configuration:
[    0.104229] .... node  #0, CPUs:      #1 #2 #3
[    0.112443] smp: Brought up 1 node, 4 CPUs
[    0.112445] smpboot: Total of 4 processors activated (19954.96 BogoMIPS)
[    0.115530] devtmpfs: initialized
[    0.115591] x86/mm: Memory block size: 128MB
[    0.118807] evm: security.selinux
[    0.118808] evm: security.SMACK64
[    0.118808] evm: security.SMACK64EXEC
[    0.118808] evm: security.SMACK64TRANSMUTE
[    0.118809] evm: security.SMACK64MMAP
[    0.118809] evm: security.ima
[    0.118809] evm: security.capability
[    0.118874] PM: Registering ACPI NVS region [mem 0xc9754000-0xc9d54fff] (6295552 bytes)
[    0.118949] PM: Registering ACPI NVS region [mem 0xca60e000-0xca88dfff] (2621440 bytes)
[    0.118980] PM: Registering ACPI NVS region [mem 0xca894000-0xca8d6fff] (274432 bytes)
[    0.119027] clocksource: jiffies: mask: 0xffffffff max_cycles: 0xffffffff, max_idle_ns: 7645041785100000 ns
[    0.119034] futex hash table entries: 1024 (order: 4, 65536 bytes)
[    0.119069] pinctrl core: initialized pinctrl subsystem
[    0.119171] RTC time:  2:30:12, date: 06/21/17
[    0.119252] NET: Registered protocol family 16
[    0.131226] cpuidle: using governor ladder
[    0.147232] cpuidle: using governor menu
[    0.147234] PCCT header not found.
[    0.147297] ACPI FADT declares the system doesn't support PCIe ASPM, so disable it
[    0.147298] ACPI: bus type PCI registered
[    0.147299] acpiphp: ACPI Hot Plug PCI Controller Driver version: 0.5
[    0.147353] PCI: MMCONFIG for domain 0000 [bus 00-3f] at [mem 0xf8000000-0xfbffffff] (base 0xf8000000)
[    0.147355] PCI: MMCONFIG at [mem 0xf8000000-0xfbffffff] reserved in E820
[    0.147362] pmd_set_huge: Cannot satisfy [mem 0xf8000000-0xf8200000] with a huge-page mapping due to MTRR override.
[    0.147437] PCI: Using configuration type 1 for base access
[    0.147478] core: PMU erratum BJ122, BV98, HSD29 worked around, HT is on
[    0.159372] HugeTLB registered 2 MB page size, pre-allocated 0 pages
[    0.159601] ACPI: Added _OSI(Module Device)
[    0.159602] ACPI: Added _OSI(Processor Device)
[    0.159603] ACPI: Added _OSI(3.0 _SCP Extensions)
[    0.159603] ACPI: Added _OSI(Processor Aggregator Device)
[    0.159605] ACPI : EC: EC started
[    0.159606] ACPI : EC: interrupt blocked
[    0.160572] ACPI: \: Used as first EC
[    0.160573] ACPI: \: GPE=0x19, EC_CMD/EC_SC=0x66, EC_DATA=0x62
[    0.160574] ACPI: \: Used as boot ECDT EC to handle transactions
[    0.160721] ACPI: Executed 1 blocks of module-level executable AML code
[    0.292606] ACPI: [Firmware Bug]: BIOS _OSI(Linux) query ignored
[    0.293124] ACPI: Dynamic OEM Table Load:
[    0.293130] ACPI: SSDT 0xFFFF914AE5247000 000853 (v01 PmRef  Cpu0Cst  00003001 INTL 20051117)
[    0.293478] ACPI: Dynamic OEM Table Load:
[    0.293482] ACPI: SSDT 0xFFFF914AE5074000 000303 (v01 PmRef  ApIst    00003000 INTL 20051117)
[    0.293749] ACPI: Dynamic OEM Table Load:
[    0.293752] ACPI: SSDT 0xFFFF914AE518F600 000119 (v01 PmRef  ApCst    00003000 INTL 20051117)
[    0.294621] ACPI : EC: EC stopped
[    0.294621] ACPI : EC: EC started
[    0.294622] ACPI : EC: interrupt blocked
[    0.294731] ACPI: \_SB_.PCI0.LPCB.EC0_: Used as first EC
[    0.294732] ACPI: \_SB_.PCI0.LPCB.EC0_: GPE=0x19, EC_CMD/EC_SC=0x66, EC_DATA=0x62
[    0.294733] ACPI: \_SB_.PCI0.LPCB.EC0_: Used as boot DSDT EC to handle transactions
[    0.294734] ACPI: Interpreter enabled
[    0.294759] ACPI: (supports S0 S3 S4 S5)
[    0.294760] ACPI: Using IOAPIC for interrupt routing
[    0.294783] PCI: Using host bridge windows from ACPI; if necessary, use "pci=nocrs" and report a bug
[    0.421240] ACPI: PCI Root Bridge [PCI0] (domain 0000 [bus 00-3e])
[    0.421244] acpi PNP0A08:00: _OSC: OS supports [ExtendedConfig ASPM ClockPM Segments MSI]
[    0.421415] acpi PNP0A08:00: _OSC: platform does not support [PCIeHotplug PME]
[    0.421550] acpi PNP0A08:00: _OSC: OS now controls [AER PCIeCapability]
[    0.421550] acpi PNP0A08:00: FADT indicates ASPM is unsupported, using BIOS configuration
[    0.422001] PCI host bridge to bus 0000:00
[    0.422003] pci_bus 0000:00: root bus resource [io  0x0000-0x0cf7 window]
[    0.422004] pci_bus 0000:00: root bus resource [io  0x0d00-0xffff window]
[    0.422005] pci_bus 0000:00: root bus resource [mem 0x000a0000-0x000bffff window]
[    0.422006] pci_bus 0000:00: root bus resource [mem 0x000d0000-0x000d3fff window]
[    0.422007] pci_bus 0000:00: root bus resource [mem 0x000d4000-0x000d7fff window]
[    0.422008] pci_bus 0000:00: root bus resource [mem 0x000d8000-0x000dbfff window]
[    0.422009] pci_bus 0000:00: root bus resource [mem 0x000dc000-0x000dffff window]
[    0.422010] pci_bus 0000:00: root bus resource [mem 0xcfe00000-0xfeafffff window]
[    0.422011] pci_bus 0000:00: root bus resource [bus 00-3e]
[    0.422018] pci 0000:00:00.0: [8086:0154] type 00 class 0x060000
[    0.422110] pci 0000:00:01.0: [8086:0151] type 01 class 0x060400
[    0.422141] pci 0000:00:01.0: PME# supported from D0 D3hot D3cold
[    0.422188] pci 0000:00:01.0: System wakeup disabled by ACPI
[    0.422225] pci 0000:00:02.0: [8086:0166] type 00 class 0x030000
[    0.422234] pci 0000:00:02.0: reg 0x10: [mem 0xf7400000-0xf77fffff 64bit]
[    0.422240] pci 0000:00:02.0: reg 0x18: [mem 0xd0000000-0xdfffffff 64bit pref]
[    0.422244] pci 0000:00:02.0: reg 0x20: [io  0xf000-0xf03f]
[    0.422374] pci 0000:00:14.0: [8086:1e31] type 00 class 0x0c0330
[    0.422395] pci 0000:00:14.0: reg 0x10: [mem 0xf7a00000-0xf7a0ffff 64bit]
[    0.422467] pci 0000:00:14.0: PME# supported from D3hot D3cold
[    0.422515] pci 0000:00:14.0: System wakeup disabled by ACPI
[    0.422551] pci 0000:00:16.0: [8086:1e3a] type 00 class 0x078000
[    0.422572] pci 0000:00:16.0: reg 0x10: [mem 0xf7a1a000-0xf7a1a00f 64bit]
[    0.422647] pci 0000:00:16.0: PME# supported from D0 D3hot D3cold
[    0.422731] pci 0000:00:1a.0: [8086:1e2d] type 00 class 0x0c0320
[    0.422749] pci 0000:00:1a.0: reg 0x10: [mem 0xf7a18000-0xf7a183ff]
[    0.422834] pci 0000:00:1a.0: PME# supported from D0 D3hot D3cold
[    0.422882] pci 0000:00:1a.0: System wakeup disabled by ACPI
[    0.422918] pci 0000:00:1b.0: [8086:1e20] type 00 class 0x040300
[    0.422935] pci 0000:00:1b.0: reg 0x10: [mem 0xf7a10000-0xf7a13fff 64bit]
[    0.423010] pci 0000:00:1b.0: PME# supported from D0 D3hot D3cold
[    0.423062] pci 0000:00:1b.0: System wakeup disabled by ACPI
[    0.423095] pci 0000:00:1c.0: [8086:1e10] type 01 class 0x060400
[    0.423173] pci 0000:00:1c.0: PME# supported from D0 D3hot D3cold
[    0.423257] pci 0000:00:1c.1: [8086:1e12] type 01 class 0x060400
[    0.423335] pci 0000:00:1c.1: PME# supported from D0 D3hot D3cold
[    0.423425] pci 0000:00:1c.3: [8086:1e16] type 01 class 0x060400
[    0.423503] pci 0000:00:1c.3: PME# supported from D0 D3hot D3cold
[    0.423555] pci 0000:00:1c.3: System wakeup disabled by ACPI
[    0.423594] pci 0000:00:1d.0: [8086:1e26] type 00 class 0x0c0320
[    0.423612] pci 0000:00:1d.0: reg 0x10: [mem 0xf7a17000-0xf7a173ff]
[    0.423697] pci 0000:00:1d.0: PME# supported from D0 D3hot D3cold
[    0.423745] pci 0000:00:1d.0: System wakeup disabled by ACPI
[    0.423779] pci 0000:00:1f.0: [8086:1e59] type 00 class 0x060100
[    0.423956] pci 0000:00:1f.2: [8086:1e03] type 00 class 0x010601
[    0.423971] pci 0000:00:1f.2: reg 0x10: [io  0xf0b0-0xf0b7]
[    0.423979] pci 0000:00:1f.2: reg 0x14: [io  0xf0a0-0xf0a3]
[    0.423986] pci 0000:00:1f.2: reg 0x18: [io  0xf090-0xf097]
[    0.423994] pci 0000:00:1f.2: reg 0x1c: [io  0xf080-0xf083]
[    0.424001] pci 0000:00:1f.2: reg 0x20: [io  0xf060-0xf07f]
[    0.424009] pci 0000:00:1f.2: reg 0x24: [mem 0xf7a16000-0xf7a167ff]
[    0.424051] pci 0000:00:1f.2: PME# supported from D3hot
[    0.424126] pci 0000:00:1f.3: [8086:1e22] type 00 class 0x0c0500
[    0.424142] pci 0000:00:1f.3: reg 0x10: [mem 0xf7a15000-0xf7a150ff 64bit]
[    0.424162] pci 0000:00:1f.3: reg 0x20: [io  0xf040-0xf05f]
[    0.424294] pci 0000:01:00.0: [10de:1058] type 00 class 0x030000
[    0.424305] pci 0000:01:00.0: reg 0x10: [mem 0xf6000000-0xf6ffffff]
[    0.424315] pci 0000:01:00.0: reg 0x14: [mem 0xe0000000-0xe7ffffff 64bit pref]
[    0.424325] pci 0000:01:00.0: reg 0x1c: [mem 0xe8000000-0xe9ffffff 64bit pref]
[    0.424332] pci 0000:01:00.0: reg 0x24: [io  0xe000-0xe07f]
[    0.424338] pci 0000:01:00.0: reg 0x30: [mem 0xf7000000-0xf707ffff pref]
[    0.435386] pci 0000:00:01.0: PCI bridge to [bus 01]
[    0.435390] pci 0000:00:01.0:   bridge window [io  0xe000-0xefff]
[    0.435393] pci 0000:00:01.0:   bridge window [mem 0xf6000000-0xf70fffff]
[    0.435398] pci 0000:00:01.0:   bridge window [mem 0xe0000000-0xe9ffffff 64bit pref]
[    0.435473] pci 0000:00:1c.0: PCI bridge to [bus 02]
[    0.435558] pci 0000:03:00.0: [168c:0032] type 00 class 0x028000
[    0.435589] pci 0000:03:00.0: reg 0x10: [mem 0xf7900000-0xf797ffff 64bit]
[    0.435652] pci 0000:03:00.0: reg 0x30: [mem 0xf7980000-0xf798ffff pref]
[    0.435737] pci 0000:03:00.0: supports D1 D2
[    0.435738] pci 0000:03:00.0: PME# supported from D0 D1 D2 D3hot D3cold
[    0.435782] pci 0000:03:00.0: System wakeup disabled by ACPI
[    0.447397] pci 0000:00:1c.1: PCI bridge to [bus 03]
[    0.447407] pci 0000:00:1c.1:   bridge window [mem 0xf7900000-0xf79fffff]
[    0.447504] pci 0000:04:00.0: [10ec:5289] type 00 class 0xff0000
[    0.447527] pci 0000:04:00.0: reg 0x10: [mem 0xf7800000-0xf780ffff]
[    0.447702] pci 0000:04:00.0: supports D1 D2
[    0.447703] pci 0000:04:00.0: PME# supported from D1 D2 D3hot D3cold
[    0.447792] pci 0000:04:00.2: [10ec:8168] type 00 class 0x020000
[    0.447815] pci 0000:04:00.2: reg 0x10: [io  0xd000-0xd0ff]
[    0.447849] pci 0000:04:00.2: reg 0x18: [mem 0xea104000-0xea104fff 64bit pref]
[    0.447870] pci 0000:04:00.2: reg 0x20: [mem 0xea100000-0xea103fff 64bit pref]
[    0.447971] pci 0000:04:00.2: supports D1 D2
[    0.447972] pci 0000:04:00.2: PME# supported from D0 D1 D2 D3hot D3cold
[    0.448014] pci 0000:04:00.2: System wakeup disabled by ACPI
[    0.459413] pci 0000:00:1c.3: PCI bridge to [bus 04]
[    0.459419] pci 0000:00:1c.3:   bridge window [io  0xd000-0xdfff]
[    0.459425] pci 0000:00:1c.3:   bridge window [mem 0xf7800000-0xf78fffff]
[    0.459445] pci 0000:00:1c.3:   bridge window [mem 0xea100000-0xea1fffff 64bit pref]
[    0.519952] ACPI: PCI Interrupt Link [LNKA] (IRQs 3 4 5 6 7 10 *11 12)
[    0.519998] ACPI: PCI Interrupt Link [LNKB] (IRQs *3 4 5 6 7 10 12)
[    0.520043] ACPI: PCI Interrupt Link [LNKC] (IRQs 3 4 5 6 7 *10 12)
[    0.520086] ACPI: PCI Interrupt Link [LNKD] (IRQs 3 4 5 6 7 *10 12)
[    0.520130] ACPI: PCI Interrupt Link [LNKE] (IRQs 3 4 5 6 7 10 12) *0, disabled.
[    0.520173] ACPI: PCI Interrupt Link [LNKF] (IRQs 3 4 5 6 7 10 12) *0, disabled.
[    0.520217] ACPI: PCI Interrupt Link [LNKG] (IRQs 3 4 *5 6 7 10 12)
[    0.520260] ACPI: PCI Interrupt Link [LNKH] (IRQs 3 *4 5 6 7 10 12)
[    0.520404] ACPI: Enabled 4 GPEs in block 00 to 3F
[    0.520478] ACPI : EC: interrupt unblocked
[    0.520483] ACPI : EC: event unblocked
[    0.520502] ACPI: \_SB_.PCI0.LPCB.EC0_: GPE=0x19, EC_CMD/EC_SC=0x66, EC_DATA=0x62
[    0.520504] ACPI: \_SB_.PCI0.LPCB.EC0_: Used as boot DSDT EC to handle transactions and events
[    0.520731] SCSI subsystem initialized
[    0.520762] libata version 3.00 loaded.
[    0.520796] pci 0000:00:02.0: vgaarb: setting as boot VGA device
[    0.520798] pci 0000:00:02.0: vgaarb: VGA device added: decodes=io+mem,owns=io+mem,locks=none
[    0.520802] pci 0000:01:00.0: vgaarb: VGA device added: decodes=io+mem,owns=none,locks=none
[    0.520804] pci 0000:01:00.0: vgaarb: bridge control possible
[    0.520804] pci 0000:00:02.0: vgaarb: no bridge control possible
[    0.520805] vgaarb: loaded
[    0.520820] ACPI: bus type USB registered
[    0.520834] usbcore: registered new interface driver usbfs
[    0.520840] usbcore: registered new interface driver hub
[    0.520855] usbcore: registered new device driver usb
[    0.520918] Registered efivars operations
[    0.551633] PCI: Using ACPI for IRQ routing
[    0.553192] PCI: pci_cache_line_size set to 64 bytes
[    0.553248] e820: reserve RAM buffer [mem 0x0009f000-0x0009ffff]
[    0.553249] e820: reserve RAM buffer [mem 0x40004000-0x43ffffff]
[    0.553250] e820: reserve RAM buffer [mem 0xc9754000-0xcbffffff]
[    0.553255] e820: reserve RAM buffer [mem 0xc9d6f000-0xcbffffff]
[    0.553261] e820: reserve RAM buffer [mem 0xc9d77000-0xcbffffff]
[    0.553266] e820: reserve RAM buffer [mem 0xc9f17000-0xcbffffff]
[    0.553270] e820: reserve RAM buffer [mem 0xc9f64000-0xcbffffff]
[    0.553275] e820: reserve RAM buffer [mem 0xc9f8c000-0xcbffffff]
[    0.553279] e820: reserve RAM buffer [mem 0xc9fa5000-0xcbffffff]
[    0.553284] e820: reserve RAM buffer [mem 0xc9fb3000-0xcbffffff]
[    0.553288] e820: reserve RAM buffer [mem 0xc9fc3000-0xcbffffff]
[    0.553292] e820: reserve RAM buffer [mem 0xc9fcf000-0xcbffffff]
[    0.553295] e820: reserve RAM buffer [mem 0xca000000-0xcbffffff]
[    0.553299] e820: reserve RAM buffer [mem 0xca011000-0xcbffffff]
[    0.553302] e820: reserve RAM buffer [mem 0xca04b000-0xcbffffff]
[    0.553305] e820: reserve RAM buffer [mem 0xca04d000-0xcbffffff]
[    0.553308] e820: reserve RAM buffer [mem 0xca050000-0xcbffffff]
[    0.553310] e820: reserve RAM buffer [mem 0xca06b000-0xcbffffff]
[    0.553313] e820: reserve RAM buffer [mem 0xca894000-0xcbffffff]
[    0.553314] e820: reserve RAM buffer [mem 0xcace4000-0xcbffffff]
[    0.553315] e820: reserve RAM buffer [mem 0xcb000000-0xcbffffff]
[    0.553316] e820: reserve RAM buffer [mem 0x22f200000-0x22fffffff]
[    0.553397] NetLabel: Initializing
[    0.553398] NetLabel:  domain hash size = 128
[    0.553398] NetLabel:  protocols = UNLABELED CIPSOv4 CALIPSO
[    0.553413] NetLabel:  unlabeled traffic allowed by default
[    0.553512] hpet0: at MMIO 0xfed00000, IRQs 2, 8, 0, 0, 0, 0, 0, 0
[    0.553516] hpet0: 8 comparators, 64-bit 14.318180 MHz counter
[    0.555536] clocksource: Switched to clocksource hpet
[    0.562070] VFS: Disk quotas dquot_6.6.0
[    0.562090] VFS: Dquot-cache hash table entries: 512 (order 0, 4096 bytes)
[    0.562177] AppArmor: AppArmor Filesystem Enabled
[    0.562224] pnp: PnP ACPI init
[    0.562341] system 00:00: [mem 0xfed40000-0xfed44fff] has been reserved
[    0.562345] system 00:00: Plug and Play ACPI device, IDs PNP0c01 (active)
[    0.619719] system 00:01: [io  0x0680-0x069f] has been reserved
[    0.619721] system 00:01: [io  0x1000-0x100f] has been reserved
[    0.619722] system 00:01: [io  0xffff] has been reserved
[    0.619723] system 00:01: [io  0xffff] has been reserved
[    0.619724] system 00:01: [io  0x0400-0x0453] has been reserved
[    0.619725] system 00:01: [io  0x0458-0x047f] has been reserved
[    0.619726] system 00:01: [io  0x0500-0x057f] has been reserved
[    0.619727] system 00:01: [io  0x164e-0x164f] has been reserved
[    0.619730] system 00:01: Plug and Play ACPI device, IDs PNP0c02 (active)
[    0.619753] pnp 00:02: Plug and Play ACPI device, IDs PNP0b00 (active)
[    0.619801] system 00:03: [io  0x0454-0x0457] has been reserved
[    0.619803] system 00:03: Plug and Play ACPI device, IDs INT3f0d PNP0c02 (active)
[    0.619849] system 00:04: [io  0x04d0-0x04d1] has been reserved
[    0.619851] system 00:04: Plug and Play ACPI device, IDs PNP0c02 (active)
[    0.619904] pnp 00:05: Plug and Play ACPI device, IDs ETD0108 SYN0a00 SYN0002 PNP0f03 PNP0f13 PNP0f12 (active)
[    0.619937] pnp 00:06: Plug and Play ACPI device, IDs ATK3001 PNP030b (active)
[    0.620105] system 00:07: [mem 0xfed1c000-0xfed1ffff] has been reserved
[    0.620107] system 00:07: [mem 0xfed10000-0xfed17fff] has been reserved
[    0.620108] system 00:07: [mem 0xfed18000-0xfed18fff] has been reserved
[    0.620109] system 00:07: [mem 0xfed19000-0xfed19fff] has been reserved
[    0.620111] system 00:07: [mem 0xf8000000-0xfbffffff] has been reserved
[    0.620112] system 00:07: [mem 0xfed20000-0xfed3ffff] has been reserved
[    0.620113] system 00:07: [mem 0xfed90000-0xfed93fff] has been reserved
[    0.620114] system 00:07: [mem 0xfed45000-0xfed8ffff] has been reserved
[    0.620116] system 00:07: [mem 0xff000000-0xffffffff] has been reserved
[    0.620117] system 00:07: [mem 0xfee00000-0xfeefffff] could not be reserved
[    0.620118] system 00:07: [mem 0xcfe00000-0xcfe00fff] has been reserved
[    0.620120] system 00:07: Plug and Play ACPI device, IDs PNP0c02 (active)
[    0.620189] system 00:08: [mem 0xcfe00000-0xcfe00fff] has been reserved
[    0.620191] system 00:08: Plug and Play ACPI device, IDs PNP0c02 (active)
[    0.620326] system 00:09: [mem 0x20000000-0x201fffff] has been reserved
[    0.620327] system 00:09: [mem 0x40004000-0x40004fff] has been reserved
[    0.620329] system 00:09: Plug and Play ACPI device, IDs PNP0c01 (active)
[    0.620359] pnp: PnP ACPI: found 10 devices
[    0.626431] clocksource: acpi_pm: mask: 0xffffff max_cycles: 0xffffff, max_idle_ns: 2085701024 ns
[    0.626466] pci 0000:00:01.0: PCI bridge to [bus 01]
[    0.626468] pci 0000:00:01.0:   bridge window [io  0xe000-0xefff]
[    0.626470] pci 0000:00:01.0:   bridge window [mem 0xf6000000-0xf70fffff]
[    0.626472] pci 0000:00:01.0:   bridge window [mem 0xe0000000-0xe9ffffff 64bit pref]
[    0.626475] pci 0000:00:1c.0: PCI bridge to [bus 02]
[    0.626486] pci 0000:00:1c.1: PCI bridge to [bus 03]
[    0.626490] pci 0000:00:1c.1:   bridge window [mem 0xf7900000-0xf79fffff]
[    0.626499] pci 0000:00:1c.3: PCI bridge to [bus 04]
[    0.626501] pci 0000:00:1c.3:   bridge window [io  0xd000-0xdfff]
[    0.626506] pci 0000:00:1c.3:   bridge window [mem 0xf7800000-0xf78fffff]
[    0.626509] pci 0000:00:1c.3:   bridge window [mem 0xea100000-0xea1fffff 64bit pref]
[    0.626517] pci_bus 0000:00: resource 4 [io  0x0000-0x0cf7 window]
[    0.626518] pci_bus 0000:00: resource 5 [io  0x0d00-0xffff window]
[    0.626520] pci_bus 0000:00: resource 6 [mem 0x000a0000-0x000bffff window]
[    0.626521] pci_bus 0000:00: resource 7 [mem 0x000d0000-0x000d3fff window]
[    0.626522] pci_bus 0000:00: resource 8 [mem 0x000d4000-0x000d7fff window]
[    0.626523] pci_bus 0000:00: resource 9 [mem 0x000d8000-0x000dbfff window]
[    0.626524] pci_bus 0000:00: resource 10 [mem 0x000dc000-0x000dffff window]
[    0.626525] pci_bus 0000:00: resource 11 [mem 0xcfe00000-0xfeafffff window]
[    0.626526] pci_bus 0000:01: resource 0 [io  0xe000-0xefff]
[    0.626527] pci_bus 0000:01: resource 1 [mem 0xf6000000-0xf70fffff]
[    0.626528] pci_bus 0000:01: resource 2 [mem 0xe0000000-0xe9ffffff 64bit pref]
[    0.626529] pci_bus 0000:03: resource 1 [mem 0xf7900000-0xf79fffff]
[    0.626530] pci_bus 0000:04: resource 0 [io  0xd000-0xdfff]
[    0.626531] pci_bus 0000:04: resource 1 [mem 0xf7800000-0xf78fffff]
[    0.626532] pci_bus 0000:04: resource 2 [mem 0xea100000-0xea1fffff 64bit pref]
[    0.626625] NET: Registered protocol family 2
[    0.626777] TCP established hash table entries: 65536 (order: 7, 524288 bytes)
[    0.626893] TCP bind hash table entries: 65536 (order: 8, 1048576 bytes)
[    0.627005] TCP: Hash tables configured (established 65536 bind 65536)
[    0.627026] UDP hash table entries: 4096 (order: 5, 131072 bytes)
[    0.627047] UDP-Lite hash table entries: 4096 (order: 5, 131072 bytes)
[    0.627090] NET: Registered protocol family 1
[    0.627103] pci 0000:00:02.0: Video device with shadowed ROM at [mem 0x000c0000-0x000dffff]
[    0.675678] PCI: CLS 64 bytes, default 64
[    0.675723] Unpacking initramfs...
[    1.264846] Freeing initrd memory: 41232K
[    1.264850] PCI-DMA: Using software bounce buffering for IO (SWIOTLB)
[    1.264852] software IO TLB [mem 0xba65a000-0xbe65a000] (64MB) mapped at [ffff91497a65a000-ffff91497e659fff]
[    1.265117] Scanning for low memory corruption every 60 seconds
[    1.265382] audit: initializing netlink subsys (disabled)
[    1.265418] audit: type=2000 audit(1498012213.240:1): initialized
[    1.265770] Initialise system trusted keyrings
[    1.265840] workingset: timestamp_bits=36 max_order=21 bucket_order=0
[    1.267084] zbud: loaded
[    1.267476] squashfs: version 4.0 (2009/01/31) Phillip Lougher
[    1.267668] fuse init (API version 7.26)
[    1.268975] Key type asymmetric registered
[    1.268976] Asymmetric key parser 'x509' registered
[    1.269009] Block layer SCSI generic (bsg) driver version 0.4 loaded (major 248)
[    1.269035] io scheduler noop registered
[    1.269036] io scheduler deadline registered
[    1.269042] io scheduler cfq registered (default)
[    1.269655] efifb: probing for efifb
[    1.269668] efifb: framebuffer at 0xd0000000, using 3072k, total 3072k
[    1.269669] efifb: mode is 1024x768x32, linelength=4096, pages=1
[    1.269669] efifb: scrolling: redraw
[    1.269670] efifb: Truecolor: size=8:8:8:8, shift=24:16:8:0
[    1.269753] Console: switching to colour frame buffer device 128x48
[    1.269766] fb0: EFI VGA frame buffer device
[    1.269772] intel_idle: MWAIT substates: 0x21120
[    1.269773] intel_idle: v0.4.1 model 0x3A
[    1.269916] intel_idle: lapic_timer_reliable_states 0xffffffff
[    1.270001] ACPI: AC Adapter [AC0] (on-line)
[    1.315684] input: Lid Switch as /devices/LNXSYSTM:00/LNXSYBUS:00/PNP0C0D:00/input/input0
[    1.315690] ACPI: Lid Switch [LID]
[    1.315723] input: Sleep Button as /devices/LNXSYSTM:00/LNXSYBUS:00/PNP0C0E:00/input/input1
[    1.315725] ACPI: Sleep Button [SLPB]
[    1.315753] input: Power Button as /devices/LNXSYSTM:00/LNXPWRBN:00/input/input2
[    1.315755] ACPI: Power Button [PWRF]
[    1.316346] (NULL device *): hwmon_device_register() is deprecated. Please convert the driver to use hwmon_device_register_with_info().
[    1.316447] thermal LNXTHERM:00: registered as thermal_zone0
[    1.316448] ACPI: Thermal Zone [THRM] (37 C)
[    1.316474] GHES: HEST is not enabled!
[    1.316598] Serial: 8250/16550 driver, 32 ports, IRQ sharing enabled
[    1.318727] Linux agpgart interface v0.103
[    1.320552] loop: module loaded
[    1.320702] libphy: Fixed MDIO Bus: probed
[    1.320703] tun: Universal TUN/TAP device driver, 1.6
[    1.320704] tun: (C) 1999-2004 Max Krasnyansky <maxk@qualcomm.com>
[    1.320737] PPP generic driver version 2.4.2
[    1.320778] ehci_hcd: USB 2.0 'Enhanced' Host Controller (EHCI) Driver
[    1.320780] ehci-pci: EHCI PCI platform driver
[    1.320895] ehci-pci 0000:00:1a.0: EHCI Host Controller
[    1.320900] ehci-pci 0000:00:1a.0: new USB bus registered, assigned bus number 1
[    1.320911] ehci-pci 0000:00:1a.0: debug port 2
[    1.324807] ehci-pci 0000:00:1a.0: cache line size of 64 is not supported
[    1.324824] ehci-pci 0000:00:1a.0: irq 16, io mem 0xf7a18000
[    1.339544] ehci-pci 0000:00:1a.0: USB 2.0 started, EHCI 1.00
[    1.339603] usb usb1: New USB device found, idVendor=1d6b, idProduct=0002
[    1.339604] usb usb1: New USB device strings: Mfr=3, Product=2, SerialNumber=1
[    1.339605] usb usb1: Product: EHCI Host Controller
[    1.339606] usb usb1: Manufacturer: Linux 4.10.0-22-generic ehci_hcd
[    1.339607] usb usb1: SerialNumber: 0000:00:1a.0
[    1.339732] hub 1-0:1.0: USB hub found
[    1.339736] hub 1-0:1.0: 2 ports detected
[    1.339910] ehci-pci 0000:00:1d.0: EHCI Host Controller
[    1.339913] ehci-pci 0000:00:1d.0: new USB bus registered, assigned bus number 2
[    1.339924] ehci-pci 0000:00:1d.0: debug port 2
[    1.343813] ehci-pci 0000:00:1d.0: cache line size of 64 is not supported
[    1.343820] ehci-pci 0000:00:1d.0: irq 23, io mem 0xf7a17000
[    1.359541] ehci-pci 0000:00:1d.0: USB 2.0 started, EHCI 1.00
[    1.359596] usb usb2: New USB device found, idVendor=1d6b, idProduct=0002
[    1.359598] usb usb2: New USB device strings: Mfr=3, Product=2, SerialNumber=1
[    1.359599] usb usb2: Product: EHCI Host Controller
[    1.359601] usb usb2: Manufacturer: Linux 4.10.0-22-generic ehci_hcd
[    1.359602] usb usb2: SerialNumber: 0000:00:1d.0
[    1.359818] hub 2-0:1.0: USB hub found
[    1.359826] hub 2-0:1.0: 2 ports detected
[    1.359866] ACPI: Battery Slot [BAT0] (battery present)
[    1.359935] ehci-platform: EHCI generic platform driver
[    1.359944] ohci_hcd: USB 1.1 'Open' Host Controller (OHCI) Driver
[    1.359946] ohci-pci: OHCI PCI platform driver
[    1.359953] ohci-platform: OHCI generic platform driver
[    1.359958] uhci_hcd: USB Universal Host Controller Interface driver
[    1.360063] xhci_hcd 0000:00:14.0: xHCI Host Controller
[    1.360066] xhci_hcd 0000:00:14.0: new USB bus registered, assigned bus number 3
[    1.361149] xhci_hcd 0000:00:14.0: hcc params 0x20007181 hci version 0x100 quirks 0x0000b930
[    1.361154] xhci_hcd 0000:00:14.0: cache line size of 64 is not supported
[    1.361235] usb usb3: New USB device found, idVendor=1d6b, idProduct=0002
[    1.361236] usb usb3: New USB device strings: Mfr=3, Product=2, SerialNumber=1
[    1.361237] usb usb3: Product: xHCI Host Controller
[    1.361238] usb usb3: Manufacturer: Linux 4.10.0-22-generic xhci-hcd
[    1.361239] usb usb3: SerialNumber: 0000:00:14.0
[    1.361344] hub 3-0:1.0: USB hub found
[    1.361352] hub 3-0:1.0: 4 ports detected
[    1.361444] xhci_hcd 0000:00:14.0: xHCI Host Controller
[    1.361446] xhci_hcd 0000:00:14.0: new USB bus registered, assigned bus number 4
[    1.361471] usb usb4: New USB device found, idVendor=1d6b, idProduct=0003
[    1.361472] usb usb4: New USB device strings: Mfr=3, Product=2, SerialNumber=1
[    1.361473] usb usb4: Product: xHCI Host Controller
[    1.361474] usb usb4: Manufacturer: Linux 4.10.0-22-generic xhci-hcd
[    1.361474] usb usb4: SerialNumber: 0000:00:14.0
[    1.361575] hub 4-0:1.0: USB hub found
[    1.361584] hub 4-0:1.0: 4 ports detected
[    1.361714] i8042: PNP: PS/2 Controller [PNP030b:PS2K,PNP0f03:PS2M] at 0x60,0x64 irq 1,12
[    1.363467] i8042: Detected active multiplexing controller, rev 1.1
[    1.364400] serio: i8042 KBD port at 0x60,0x64 irq 1
[    1.364403] serio: i8042 AUX0 port at 0x60,0x64 irq 12
[    1.364428] serio: i8042 AUX1 port at 0x60,0x64 irq 12
[    1.364448] serio: i8042 AUX2 port at 0x60,0x64 irq 12
[    1.364467] serio: i8042 AUX3 port at 0x60,0x64 irq 12
[    1.364613] mousedev: PS/2 mouse device common for all mice
[    1.364870] rtc_cmos 00:02: RTC can wake from S4
[    1.364993] rtc_cmos 00:02: rtc core: registered rtc_cmos as rtc0
[    1.365018] rtc_cmos 00:02: alarms up to one month, y3k, 242 bytes nvram, hpet irqs
[    1.365023] i2c /dev entries driver
[    1.365066] device-mapper: uevent: version 1.0.3
[    1.365129] device-mapper: ioctl: 4.35.0-ioctl (2016-06-23) initialised: dm-devel@redhat.com
[    1.365134] intel_pstate: Intel P-state driver initializing
[    1.365303] ledtrig-cpu: registered to indicate activity on CPUs
[    1.365304] EFI Variables Facility v0.08 2004-May-17
[    1.397056] NET: Registered protocol family 10
[    1.400146] Segment Routing with IPv6
[    1.400161] NET: Registered protocol family 17
[    1.400168] Key type dns_resolver registered
[    1.400380] microcode: sig=0x306a9, pf=0x10, revision=0x1c
[    1.400422] microcode: Microcode Update Driver: v2.2.
[    1.400513] registered taskstats version 1
[    1.400520] Loading compiled-in X.509 certificates
[    1.402496] Loaded X.509 cert 'Build time autogenerated kernel key: a167cdd0c8d1eea96632c95731fa483a527957b7'
[    1.402511] zswap: loaded using pool lzo/zbud
[    1.410846] Key type big_key registered
[    1.410851] Key type trusted registered
[    1.412354] Key type encrypted registered
[    1.412357] AppArmor: AppArmor sha1 policy hashing enabled
[    1.412358] ima: No TPM chip found, activating TPM-bypass! (rc=-19)
[    1.412372] evm: HMAC attrs: 0x1
[    1.412673]   Magic number: 5:265:511
[    1.412774] rtc_cmos 00:02: setting system clock to 2017-06-21 02:30:14 UTC (1498012214)
[    1.412845] BIOS EDD facility v0.16 2004-Jun-25, 0 devices found
[    1.412845] EDD information not available.
[    1.412950] PM: Hibernation image not present or could not be loaded.
[    1.414348] Freeing unused kernel memory: 2228K
[    1.414349] Write protecting the kernel read-only data: 14336k
[    1.414628] Freeing unused kernel memory: 1144K
[    1.415130] Freeing unused kernel memory: 280K
[    1.421387] x86/mm: Checked W+X mappings: passed, no W+X pages found.
[    1.424154] input: AT Translated Set 2 keyboard as /devices/platform/i8042/serio0/input/input3
[    1.430324] random: systemd-udevd: uninitialized urandom read (16 bytes read)
[    1.430385] random: systemd-udevd: uninitialized urandom read (16 bytes read)
[    1.430393] random: systemd-udevd: uninitialized urandom read (16 bytes read)
[    1.430763] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.430789] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.431643] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.431686] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.431698] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.431732] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.431776] random: udevadm: uninitialized urandom read (16 bytes read)
[    1.451946] FUJITSU Extended Socket Network Device Driver - version 1.2 - Copyright (c) 2015 FUJITSU LIMITED
[    1.464229] rtsx_pci 0000:04:00.0: rtsx_pci_acquire_irq: pcr->msi_en = 1, pci->irq = 26
[    1.466433] ahci 0000:00:1f.2: version 3.0
[    1.467766] [drm] Initialized
[    1.468309] r8169 Gigabit Ethernet driver 2.3LK-NAPI loaded
[    1.468315] r8169 0000:04:00.2: can't disable ASPM; OS doesn't have ASPM control
[    1.469106] r8169 0000:04:00.2 eth0: RTL8411 at 0xffffb5f440cd1000, 50:46:5d:e0:49:c2, XID 08800800 IRQ 28
[    1.469107] r8169 0000:04:00.2 eth0: jumbo features [frames: 9200 bytes, tx checksumming: ko]
[    1.476715] ahci 0000:00:1f.2: AHCI 0001.0300 32 slots 6 ports 6 Gbps 0x5 impl SATA mode
[    1.476718] ahci 0000:00:1f.2: flags: 64bit ncq pm led clo pio slum part ems apst 
[    1.488348] scsi host0: ahci
[    1.488713] scsi host1: ahci
[    1.489207] scsi host2: ahci
[    1.491567] scsi host3: ahci
[    1.498444] r8169 0000:04:00.2 enp4s0f2: renamed from eth0
[    1.499236] scsi host4: ahci
[    1.499363] scsi host5: ahci
[    1.499422] ata1: SATA max UDMA/133 abar m2048@0xf7a16000 port 0xf7a16100 irq 27
[    1.499423] ata2: DUMMY
[    1.499426] ata3: SATA max UDMA/133 abar m2048@0xf7a16000 port 0xf7a16200 irq 27
[    1.499426] ata4: DUMMY
[    1.499427] ata5: DUMMY
[    1.499428] ata6: DUMMY
[    1.499719] [drm] Memory usable by graphics device = 2048M
[    1.499721] checking generic (d0000000 300000) vs hw (d0000000 10000000)
[    1.499722] fb: switching to inteldrmfb from EFI VGA
[    1.499746] Console: switching to colour dummy device 80x25
[    1.499826] [drm] Replacing VGA console driver
[    1.505587] [drm] Supports vblank timestamp caching Rev 2 (21.10.2013).
[    1.505588] [drm] Driver supports precise vblank timestamp query.
[    1.508225] i915 0000:00:02.0: vgaarb: changed VGA decodes: olddecodes=io+mem,decodes=none:owns=io+mem
[    1.572356] ACPI: Video Device [PEGP] (multi-head: yes  rom: yes  post: no)
[    1.572802] input: Video Bus as /devices/LNXSYSTM:00/LNXSYBUS:00/PNP0A08:00/device:02/LNXVIDEO:00/input/input12
[    1.573428] ACPI: Video Device [GFX0] (multi-head: yes  rom: no  post: no)
[    1.575474] input: Video Bus as /devices/LNXSYSTM:00/LNXSYBUS:00/PNP0A08:00/LNXVIDEO:01/input/input13
[    1.575595] [drm] Initialized i915 1.6.0 20161121 for 0000:00:02.0 on minor 0
[    1.588205] fbcon: inteldrmfb (fb0) is primary device
[    1.588269] Console: switching to colour frame buffer device 170x48
[    1.588285] i915 0000:00:02.0: fb0: inteldrmfb frame buffer device
[    1.671567] usb 1-1: new high-speed USB device number 2 using ehci-pci
[    1.687566] usb 3-1: new full-speed USB device number 2 using xhci_hcd
[    1.687584] usb 2-1: new high-speed USB device number 2 using ehci-pci
[    1.791880] random: fast init done
[    1.814350] ata3: SATA link up 1.5 Gbps (SStatus 113 SControl 300)
[    1.814441] ata1: SATA link up 3.0 Gbps (SStatus 123 SControl 300)
[    1.815405] ata1.00: ACPI cmd f5/00:00:00:00:00:a0 (SECURITY FREEZE LOCK) filtered out
[    1.815606] ata1.00: ACPI cmd ef/10:06:00:00:00:a0 (SET FEATURES) succeeded
[    1.815608] ata1.00: ACPI cmd ef/10:03:00:00:00:a0 (SET FEATURES) filtered out
[    1.816735] ata1.00: ATA-8: Hitachi HTS545050A7E380, GG2OA6C0, max UDMA/133
[    1.816739] ata1.00: 976773168 sectors, multi 16: LBA48 NCQ (depth 31/32), AA
[    1.817305] ata3.00: ACPI cmd ef/10:06:00:00:00:a0 (SET FEATURES) succeeded
[    1.817308] ata3.00: ACPI cmd ef/10:03:00:00:00:a0 (SET FEATURES) filtered out
[    1.817828] ata1.00: ACPI cmd f5/00:00:00:00:00:a0 (SECURITY FREEZE LOCK) filtered out
[    1.818034] ata1.00: ACPI cmd ef/10:06:00:00:00:a0 (SET FEATURES) succeeded
[    1.818038] ata1.00: ACPI cmd ef/10:03:00:00:00:a0 (SET FEATURES) filtered out
[    1.818297] ata3.00: ATAPI: MATSHITADVD-RAM UJ8C0, 1.00, max UDMA/133
[    1.819180] ata1.00: configured for UDMA/133
[    1.819484] scsi 0:0:0:0: Direct-Access     ATA      Hitachi HTS54505 A6C0 PQ: 0 ANSI: 5
[    1.819899] usb 1-1: New USB device found, idVendor=8087, idProduct=0024
[    1.819903] usb 1-1: New USB device strings: Mfr=0, Product=0, SerialNumber=0
[    1.820134] hub 1-1:1.0: USB hub found
[    1.820257] hub 1-1:1.0: 6 ports detected
[    1.820756] ata3.00: ACPI cmd ef/10:06:00:00:00:a0 (SET FEATURES) succeeded
[    1.820758] ata3.00: ACPI cmd ef/10:03:00:00:00:a0 (SET FEATURES) filtered out
[    1.821740] ata3.00: configured for UDMA/133
[    1.830441] usb 3-1: New USB device found, idVendor=046d, idProduct=c52f
[    1.830443] usb 3-1: New USB device strings: Mfr=1, Product=2, SerialNumber=0
[    1.830444] usb 3-1: Product: USB Receiver
[    1.830445] usb 3-1: Manufacturer: Logitech
[    1.835024] hidraw: raw HID events driver (C) Jiri Kosina
[    1.835884] usb 2-1: New USB device found, idVendor=8087, idProduct=0024
[    1.835886] usb 2-1: New USB device strings: Mfr=0, Product=0, SerialNumber=0
[    1.836135] hub 2-1:1.0: USB hub found
[    1.836230] hub 2-1:1.0: 6 ports detected
[    1.839133] usbcore: registered new interface driver usbhid
[    1.839133] usbhid: USB HID core driver
[    1.840986] input: Logitech USB Receiver as /devices/pci0000:00/0000:00:14.0/usb3/3-1/3-1:1.0/0003:046D:C52F.0001/input/input14
[    1.841078] hid-generic 0003:046D:C52F.0001: input,hidraw0: USB HID v1.11 Mouse [Logitech USB Receiver] on usb-0000:00:14.0-1/input0
[    1.841742] input: Logitech USB Receiver as /devices/pci0000:00/0000:00:14.0/usb3/3-1/3-1:1.1/0003:046D:C52F.0002/input/input15
[    1.859740] sd 0:0:0:0: Attached scsi generic sg0 type 0
[    1.859795] sd 0:0:0:0: [sda] 976773168 512-byte logical blocks: (500 GB/466 GiB)
[    1.859796] sd 0:0:0:0: [sda] 4096-byte physical blocks
[    1.859813] sd 0:0:0:0: [sda] Write Protect is off
[    1.859815] sd 0:0:0:0: [sda] Mode Sense: 00 3a 00 00
[    1.859844] sd 0:0:0:0: [sda] Write cache: enabled, read cache: enabled, doesn't support DPO or FUA
[    1.861161] scsi 2:0:0:0: CD-ROM            MATSHITA DVD-RAM UJ8C0    1.00 PQ: 0 ANSI: 5
[    1.886943] sr 2:0:0:0: [sr0] scsi3-mmc drive: 24x/24x writer dvd-ram cd/rw xa/form2 cdda tray
[    1.886946] cdrom: Uniform CD-ROM driver Revision: 3.20
[    1.887125] sr 2:0:0:0: Attached scsi CD-ROM sr0
[    1.887187] sr 2:0:0:0: Attached scsi generic sg1 type 5
[    1.899699] hid-generic 0003:046D:C52F.0002: input,hiddev0,hidraw1: USB HID v1.11 Device [Logitech USB Receiver] on usb-0000:00:14.0-1/input1
[    1.926989]  sda: sda1 sda2 sda3
[    1.927399] sd 0:0:0:0: [sda] Attached SCSI disk
[    2.107563] usb 1-1.3: new high-speed USB device number 3 using ehci-pci
[    2.291550] tsc: Refined TSC clocksource calibration: 2494.334 MHz
[    2.291561] clocksource: tsc: mask: 0xffffffffffffffff max_cycles: 0x23f45126d86, max_idle_ns: 440795256522 ns
[    2.322651] usb 1-1.3: New USB device found, idVendor=1bcf, idProduct=2883
[    2.322654] usb 1-1.3: New USB device strings: Mfr=1, Product=2, SerialNumber=0
[    2.322656] usb 1-1.3: Product: ASUS USB2.0 Webcam
[    2.322658] usb 1-1.3: Manufacturer: 04G626000611BQ28M0023KP
[    2.422819] psmouse serio4: elantech: assuming hardware version 4 (with firmware version 0x361f03)
[    2.436425] psmouse serio4: elantech: Synaptics capabilities query result 0x10, 0x14, 0x0e.
[    2.450028] psmouse serio4: elantech: Elan sample query result 05, 24, 64
[    2.517794] input: ETPS/2 Elantech Touchpad as /devices/platform/i8042/serio4/input/input11
[    3.006842] EXT4-fs (sda2): mounted filesystem with ordered data mode. Opts: (null)
[    3.315737] clocksource: Switched to clocksource tsc
[    4.177078] random: crng init done
[    4.702726] ip_tables: (C) 2000-2006 Netfilter Core Team
[    5.358805] systemd[1]: systemd 232 running in system mode. (+PAM +AUDIT +SELINUX +IMA +APPARMOR +SMACK +SYSVINIT +UTMP +LIBCRYPTSETUP +GCRYPT +GNUTLS +ACL +XZ +LZ4 +SECCOMP +BLKID +ELFUTILS +KMOD +IDN)
[    5.358926] systemd[1]: Detected architecture x86-64.
[    5.386411] systemd[1]: Set hostname to <cky-pc>.
[    8.244202] systemd[1]: cgproxy.service: Cannot add dependency job, ignoring: Unit cgproxy.service is masked.
[    8.244206] systemd[1]: cgmanager.service: Cannot add dependency job, ignoring: Unit cgmanager.service is masked.
[    8.244780] systemd[1]: Listening on udev Kernel Socket.
[    8.244867] systemd[1]: Listening on Syslog Socket.
[    8.244879] systemd[1]: Reached target User and Group Name Lookups.
[    8.244990] systemd[1]: Set up automount Arbitrary Executable File Formats File System Automount Point.
[    8.245101] systemd[1]: Created slice User and Session Slice.
[    9.347765] lp: driver loaded but no devices found
[    9.412530] ppdev: user-space parallel port driver
[   23.407545] EXT4-fs (sda2): re-mounted. Opts: errors=remount-ro
[   23.430947] systemd-journald[256]: Received request to flush runtime journal from PID 1
[   23.510341] input: Asus Wireless Radio Control as /devices/LNXSYSTM:00/LNXSYBUS:00/ATK4001:00/input/input16
[   23.516404] wmi: Mapper loaded
[   23.538496] shpchp: Standard Hot Plug PCI Controller Driver version: 0.4
[   23.569501] ACPI Warning: SystemIO range 0x0000000000000428-0x000000000000042F conflicts with OpRegion 0x0000000000000400-0x000000000000044F (\GPIS) (20160930/utaddress-247)
[   23.569507] ACPI Warning: SystemIO range 0x0000000000000428-0x000000000000042F conflicts with OpRegion 0x0000000000000400-0x000000000000047F (\PMIO) (20160930/utaddress-247)
[   23.569512] ACPI: If an ACPI driver is available for this device, you should use it instead of the native driver
[   23.569515] ACPI Warning: SystemIO range 0x0000000000000540-0x000000000000054F conflicts with OpRegion 0x0000000000000500-0x000000000000057F (\GPIO) (20160930/utaddress-247)
[   23.569518] ACPI Warning: SystemIO range 0x0000000000000540-0x000000000000054F conflicts with OpRegion 0x0000000000000500-0x0000000000000563 (\GP01) (20160930/utaddress-247)
[   23.569522] ACPI: If an ACPI driver is available for this device, you should use it instead of the native driver
[   23.569522] ACPI Warning: SystemIO range 0x0000000000000530-0x000000000000053F conflicts with OpRegion 0x0000000000000500-0x000000000000057F (\GPIO) (20160930/utaddress-247)
[   23.569525] ACPI Warning: SystemIO range 0x0000000000000530-0x000000000000053F conflicts with OpRegion 0x0000000000000500-0x0000000000000563 (\GP01) (20160930/utaddress-247)
[   23.569528] ACPI: If an ACPI driver is available for this device, you should use it instead of the native driver
[   23.569528] ACPI Warning: SystemIO range 0x0000000000000500-0x000000000000052F conflicts with OpRegion 0x0000000000000500-0x000000000000057F (\GPIO) (20160930/utaddress-247)
[   23.569532] ACPI Warning: SystemIO range 0x0000000000000500-0x000000000000052F conflicts with OpRegion 0x0000000000000500-0x0000000000000563 (\GP01) (20160930/utaddress-247)
[   23.569534] ACPI: If an ACPI driver is available for this device, you should use it instead of the native driver
[   23.569535] lpc_ich: Resource conflict(s) found affecting gpio_ich
[   23.601508] ath: phy0: Disable PLL PowerSave
[   23.608460] ath: phy0: Enable LNA combining
[   23.609679] ath: phy0: ASPM enabled: 0x42
[   23.609681] ath: EEPROM regdomain: 0x60
[   23.609681] ath: EEPROM indicates we should expect a direct regpair map
[   23.609682] ath: Country alpha2 being used: 00
[   23.609683] ath: Regpair used: 0x60
[   23.615482] ieee80211 phy0: Selected rate control algorithm 'minstrel_ht'
[   23.615947] ieee80211 phy0: Atheros AR9485 Rev:1 mem=0xffffb5f441500000, irq=17
[   23.639873] RAPL PMU: API unit is 2^-32 Joules, 3 fixed counters, 163840 ms ovfl timer
[   23.639875] RAPL PMU: hw unit of domain pp0-core 2^-16 Joules
[   23.639876] RAPL PMU: hw unit of domain package 2^-16 Joules
[   23.639876] RAPL PMU: hw unit of domain pp1-gpu 2^-16 Joules
[   23.673017] snd_hda_codec_realtek hdaudioC0D0: autoconfig for ALC270: line_outs=1 (0x14/0x0/0x0/0x0/0x0) type:speaker
[   23.673020] snd_hda_codec_realtek hdaudioC0D0:    speaker_outs=0 (0x0/0x0/0x0/0x0/0x0)
[   23.673021] snd_hda_codec_realtek hdaudioC0D0:    hp_outs=1 (0x21/0x0/0x0/0x0/0x0)
[   23.673023] snd_hda_codec_realtek hdaudioC0D0:    mono: mono_out=0x0
[   23.673024] snd_hda_codec_realtek hdaudioC0D0:    inputs:
[   23.673025] snd_hda_codec_realtek hdaudioC0D0:      Internal Mic=0x19
[   23.673027] snd_hda_codec_realtek hdaudioC0D0:      Mic=0x18
[   23.684676] snd_hda_intel 0000:00:1b.0: bound 0000:00:02.0 (ops i915_audio_component_bind_ops [i915])
[   23.689689] intel_rapl: Found RAPL domain package
[   23.689690] intel_rapl: Found RAPL domain core
[   23.689691] intel_rapl: Found RAPL domain uncore
[   23.689694] intel_rapl: RAPL package 0 domain package locked by BIOS
[   23.716178] input: HDA Intel PCH Mic as /devices/pci0000:00/0000:00:1b.0/sound/card0/input17
[   23.716245] input: HDA Intel PCH Headphone as /devices/pci0000:00/0000:00:1b.0/sound/card0/input18
[   23.716305] input: HDA Intel PCH HDMI/DP,pcm=3 as /devices/pci0000:00/0000:00:1b.0/sound/card0/input19
[   23.934627] nvidia: loading out-of-tree module taints kernel.
[   23.934631] nvidia: module license 'NVIDIA' taints kernel.
[   23.934631] Disabling lock debugging due to kernel taint
[   23.937226] nvidia: module verification failed: signature and/or required key missing - tainting kernel
[   23.940559] nvidia 0000:01:00.0: enabling device (0000 -> 0003)
[   23.940635] nvidia 0000:01:00.0: vgaarb: changed VGA decodes: olddecodes=io+mem,decodes=none:owns=none
[   23.940763] [drm] Initialized nvidia-drm 0.0.0 20150116 for 0000:01:00.0 on minor 1
[   23.940766] NVRM: loading NVIDIA UNIX x86_64 Kernel Module  304.135  Tue Jan 17 15:26:26 PST 2017

[   24.007778] media: Linux media interface: v0.10
[   24.015151] Linux video capture interface: v2.00
[   24.024974] uvcvideo: Found UVC 1.00 device ASUS USB2.0 Webcam (1bcf:2883)
[   24.041946] uvcvideo 1-1.3:1.0: Entity type for entity Extension 3 was not initialized!
[   24.041949] uvcvideo 1-1.3:1.0: Entity type for entity Processing 2 was not initialized!
[   24.041951] uvcvideo 1-1.3:1.0: Entity type for entity Camera 1 was not initialized!
[   24.042042] input: ASUS USB2.0 Webcam as /devices/pci0000:00/0000:00:1a.0/usb1/1-1/1-1.3/1-1.3:1.0/input/input20
[   24.042111] usbcore: registered new interface driver uvcvideo
[   24.042112] USB Video Class driver (1.1.1)
[   24.070064] asus_wmi: ASUS WMI generic driver loaded
[   24.071503] asus_wmi: Initialization: 0x1
[   24.071545] asus_wmi: BIOS WMI version: 7.9
[   24.071595] asus_wmi: SFUN value: 0x4a0877
[   24.072314] input: Asus WMI hotkeys as /devices/platform/asus-nb-wmi/input/input21
[   24.094760] ath9k 0000:03:00.0 wlp3s0: renamed from wlan0
[   24.104286] asus_wmi: Number of fans: 1
[   25.350489] Adding 8270844k swap on /dev/sda3.  Priority:-1 extents:1 across:8270844k FS
[   27.674691] audit: type=1400 audit(1498012240.754:2): apparmor="STATUS" operation="profile_load" profile="unconfined" name="content-hub-clipboard" pid=789 comm="apparmor_parser"
[   27.674694] audit: type=1400 audit(1498012240.754:3): apparmor="STATUS" operation="profile_load" profile="unconfined" name="content-hub-peer-picker" pid=790 comm="apparmor_parser"
[   27.675588] audit: type=1400 audit(1498012240.758:4): apparmor="STATUS" operation="profile_load" profile="unconfined" name="url-dispatcher-bad-url-helper" pid=793 comm="apparmor_parser"
[   27.676620] audit: type=1400 audit(1498012240.758:5): apparmor="STATUS" operation="profile_load" profile="unconfined" name="/sbin/dhclient" pid=792 comm="apparmor_parser"
[   27.676622] audit: type=1400 audit(1498012240.758:6): apparmor="STATUS" operation="profile_load" profile="unconfined" name="/usr/lib/NetworkManager/nm-dhcp-client.action" pid=792 comm="apparmor_parser"
[   27.676623] audit: type=1400 audit(1498012240.758:7): apparmor="STATUS" operation="profile_load" profile="unconfined" name="/usr/lib/NetworkManager/nm-dhcp-helper" pid=792 comm="apparmor_parser"
[   27.676624] audit: type=1400 audit(1498012240.758:8): apparmor="STATUS" operation="profile_load" profile="unconfined" name="/usr/lib/connman/scripts/dhclient-script" pid=792 comm="apparmor_parser"
[   27.677743] audit: type=1400 audit(1498012240.758:9): apparmor="STATUS" operation="profile_load" profile="unconfined" name="/usr/lib/lightdm/lightdm-guest-session" pid=791 comm="apparmor_parser"
[   27.677745] audit: type=1400 audit(1498012240.758:10): apparmor="STATUS" operation="profile_load" profile="unconfined" name="/usr/lib/lightdm/lightdm-guest-session//chromium" pid=791 comm="apparmor_parser"
[   27.678711] audit: type=1400 audit(1498012240.758:11): apparmor="STATUS" operation="profile_load" profile="unconfined" name="ubuntu-printing-app" pid=797 comm="apparmor_parser"
[   27.873165] vboxdrv: Found 4 processor cores
[   27.891303] vboxdrv: TSC mode is Invariant, tentative frequency 2494329961 Hz
[   27.891304] vboxdrv: Successfully loaded version 5.1.22 (interface 0x00280000)
[   28.093950] VBoxNetFlt: Successfully started.
[   28.095047] VBoxNetAdp: Successfully started.
[   28.096432] VBoxPciLinuxInit
[   28.098112] vboxpci: IOMMU not found (not registered)
[   31.452663] IPv6: ADDRCONF(NETDEV_UP): enp4s0f2: link is not ready
[   31.810145] r8169 0000:04:00.2 enp4s0f2: link down
[   31.810214] IPv6: ADDRCONF(NETDEV_UP): enp4s0f2: link is not ready
[   31.813356] IPv6: ADDRCONF(NETDEV_UP): wlp3s0: link is not ready
[   31.828871] IPv6: ADDRCONF(NETDEV_UP): wlp3s0: link is not ready
[   31.854371] IPv6: ADDRCONF(NETDEV_UP): wlp3s0: link is not ready
[   32.559241] IPv6: ADDRCONF(NETDEV_UP): wlp3s0: link is not ready
[   33.625854] IPv6: ADDRCONF(NETDEV_UP): wlp3s0: link is not ready
[   33.699886] wlp3s0: authenticate with 7c:03:c9:0f:16:9b
[   33.714545] wlp3s0: send auth to 7c:03:c9:0f:16:9b (try 1/3)
[   33.716511] wlp3s0: authenticated
[   33.716786] wlp3s0: associating with AP with corrupt probe response
[   33.719094] wlp3s0: associate with 7c:03:c9:0f:16:9b (try 1/3)
[   33.723226] wlp3s0: RX AssocResp from 7c:03:c9:0f:16:9b (capab=0x411 status=0 aid=2)
[   33.723367] wlp3s0: associated
[   33.723410] IPv6: ADDRCONF(NETDEV_CHANGE): wlp3s0: link becomes ready
[   47.139094] systemd[1]: motd-news.timer: Adding 35min 30.242460s random time.
[   57.495446] systemd[1]: motd-news.timer: Adding 37min 41.191004s random time.
[  190.529160] SGI XFS with ACLs, security attributes, realtime, no debug enabled
[  190.630229] JFS: nTxBlock = 8192, nTxLock = 65536
[  190.697688] ntfs: driver 2.1.32 [Flags: R/O MODULE].
[  190.765764] QNX4 filesystem 0.2.3 registered.
[  190.890556] raid6: sse2x1   gen()  5650 MB/s
[  190.938581] raid6: sse2x1   xor()  4694 MB/s
[  190.986613] raid6: sse2x2   gen()  8761 MB/s
[  191.034636] raid6: sse2x2   xor()  5247 MB/s
[  191.082669] raid6: sse2x4   gen()  9615 MB/s
[  191.130695] raid6: sse2x4   xor()  6549 MB/s
[  191.130696] raid6: using algorithm sse2x4 gen() 9615 MB/s
[  191.130697] raid6: .... xor() 6549 MB/s, rmw enabled
[  191.130698] raid6: using ssse3x2 recovery algorithm
[  191.149463] xor: automatically using best checksumming function   avx       
[  191.232290] Btrfs loaded, crc32c=crc32c-intel
```


