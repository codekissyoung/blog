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
