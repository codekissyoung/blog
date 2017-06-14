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
