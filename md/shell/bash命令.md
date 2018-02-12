# 内建命令与外建命令
- **外建命令** 作为一个可执行程序放在`$PATH`所包含的目录中的。bash在执行这些命令的时候，都会进行fork(),exec()并且wait()。就是用标准的打开子进程的方式处理外部命令
- **内建命令** 都是bash自身实现的命令，它们不依靠外部的可执行文件存在。只要有bash，这些命令就可以执行。典型的内建命令有cd、pwd等。

# alias
```bash
alias ls='ls --color=auto';
# 给命令取别名，`./xxx.sh`运行shell脚本,，alias别名无效，`source`和`.`方式是起有效的，因为是在当前shell运行

# alias功能在交互打开的bash中是默认开启的，但是在bash脚本中是默认关闭的
shopt -s expand_aliases # 在脚本里启用alias功能

# 经典 alias 命令
alias rm='rm() { mv $@ ~/backup;};rm' # 配合函数，使用alias命令,将危险的rm命令，替换成mv命令
```

# bg 在后台恢复暂停的作业
```bash
cky@cky-pc:~/workspace/shell$ ./cky.sh
5540 : 1
5540 : 2
5540 : 3
^Z # 按ctrl + z 暂停作业，存入后台
[2]+  已停止               ./cky.sh
cky@cky-pc:~/workspace/shell$ bg %2
[2]+ ./cky.sh &
5540 : 8
cky@cky-pc:~/workspace/shell$ 5540 : 9
5540 : 10
5540 : 11
```

# bind 将键盘序列绑定到一个readline函数或者宏
```bash
bind -x '"\C-l":ls -l' #直接按 CTRL+L 就列出目录

cky@cky-pc:~/workspace/shell/dir$ showkey -a　# 显示指定操作的键盘序列

按任意键 - Ctrl-D 将结束这个程序

^Z 	 26 0032 0x1a
^X 	 24 0030 0x18
^C 	  3 0003 0x03
^V 	 22 0026 0x16
^B 	  2 0002 0x02
^N 	 14 0016 0x0e
^M 	 13 0015 0x0d
^L 	 12 0014 0x0c
^K 	 11 0013 0x0b

```
- bind命令用于显示和设置命令行的键盘序列绑定功能。通过这一命令，可以提高命令行中操作效率。
- 您可以利用bind命令了解有哪些按键组合与其功能，也可以自行指定要用哪些按键组合
- -d：显示按键配置的内容；
- -f<按键配置文件>：载入指定的按键配置文件；
- -l：列出所有的功能；
- -m<按键配置>：指定按键配置；
- -q<功能>：显示指定功能的按键；
- -v：列出目前的按键配置与其功能。


```bash
break   # 退出for while select until
builtin cd dir; # 执行指定的内建命令,shell命令执行时首先从函数开始，如果自定义了一个与内建命令同名的函数，那么就执行这个函数而非真正的内建命令
cd # 进入目录
command # command命令类似于builtin，也是为了避免调用同名的shell函数，命令包括shell内建命令和环境变量PATH中的命令。
continue # for while select until 循环　进行下一次迭代
```

# caller
- 将caller 命令放到函数中,将会在stdout 上打印出函数调用者的信息.
- caller 命令也可以返回在一个脚本中被source 的另一个脚本的信息.象函数一样,这是一个， "子例程调用",你会发现这个命令在调试的时候特别有用.
- ture一个返回成功(就是返回0)退出码的命令。flase一个返回失败(非0)退出码的命令。
```bash
#!/bin/bash
# cky.sh
bar(){
	echo 'bar called';
	caller 0 # 显示调用者信息
}
call_function(){
	bar;
}
call_function;
```
```bash
#!/bin/bash
# cky_call.sh
. cky.sh
```
```bash
cky@cky-pc:~/workspace/shell$ ./cky_call.sh
bar called
15 call_function cky.sh
```

# compgen 为指定单词生成可能的补全匹配


# complete 为指定的单词显示如何补全的


# declare 声明一个变量/类型
```bash
dirs # 显示当前目录
disown -h %2 # 将后台作业[Ctrl + z生成的],屏蔽HUB信号
echo 输出
enable 启用
eval
exec 用指定命令替换shell进程
exit 退出
export 声明为环境变量
fc 从历史记录中选择一条命令
fg %2 恢复后台作业到前台
getopts
hash 内置hash表，建立到PATH路径下面的路径的直接链接
help 显示帮助文件
history 显示命令历史记录
jobs  查看后台作业
kill -n PID 向进程发送信号
let 计算数学表达式
local 在函数中申明一个局部变量，只能在函数中访问到
logout 退出shell登录
popd 从目录栈中删除记录
printf 格式化打印
pushd 向目录栈添加记录
pwd 当前目录名
readonly 声明只读变量
return 强制函数以某值退出
set 设置/显示环境变量　和 shell特性
shift 将参数位置前移一位
shopt 打开/关闭shell可选行为的变量值
suspend 暂停shell的执行，直到收到SIGCONT
test 测试条件
times 显示累计的用户时间和系统时间
trap 如果收到了指定的系统信号，执行指定的命令
type 查看命令类型
ulimit 给用户指定的资源设置上限
umask 为新建的文件和目录设置默认权限
unalias 删除别名
unset 删除变量
wait 等待指定进程完成，并返回退出状态码
```

# pgrep 查出带有某字符串的进程的进程号
```bash
cky@cky-pc:~$ pgrep -l ssh
1895 ssh-agent
24486 sshd
```

# tr 替换 去重 删除
```bash
cky@cky-pc:~$ echo aaacccddd | tr -s [a-z] # 指定范围去重
acd
cky@cky-pc:~$ echo aaacccddd | tr -s [abc] # 指定字母去重
acddd
cky@cky-pc:~$ tr -s ["\n"] # 删除多余的空白行
cky@cky-pc:~/workspace/shell$ echo 'GNU is       not      UNIX' | tr -s ' ' # 删除多余的空格
GNU is not UNIX

cky@cky-pc:~$ echo "Hello world i love you " |tr [a-z] [A-Z] # 小写换成大写
HELLO WORLD I LOVE YOU
cky@cky-pc:~$ echo "HELLO GIRL I LOVE YOU" | tr [A-Z] [a-z] # 大写换成小写
hello girl i love you

cky@cky-pc:~$ echo "its 10:00 Now" | tr -c "[a-z][A-Z][: ]" "-" # -c 是反转,将不在参数1里的替换成参数2
its --:-- Now-

cky@cky-pc:~/workspace/shell$ echo hello 1 char 2 next 4 | tr -d -c '0-9 \n' # 常用于删除不在集合里的字符
 1  2  4


cky@cky-pc:~$ echo "its 10:00 Now" | tr -d "[0-9][:]" # 删除数字和冒号
its  Now

cky@cky-pc:~/workspace/shell$ echo 12345 | tr '0-9' '9876543210' # 替换是一一对应的
87654
cky@cky-pc:~/workspace/shell$ echo 12345 | tr '0-9' '9876543210' | tr '9876543210' '0-9'
12345

# ROT13 : 使用同一个命令加密，解密
cky@cky-pc:~/workspace/shell$ echo "tr came , tr saw ,tr conqurered." | tr 'a-zA-Z' 'n-za-nN-ZA-M'
ge pnzr , ge fnj ,ge pbadhererq.
cky@cky-pc:~/workspace/shell$ echo "tr came , tr saw ,tr conqurered." | tr 'a-zA-Z' 'n-za-nN-ZA-M' | tr 'a-zA-Z' 'n-za-nN-ZA-M'
tr came , tr saw ,tr conqurered.
```

# shell 数学计算
```bash
#!/bin/bash
a=8
b=3
echo "a : $a , b : $b";
let c=$a+$b
echo "c : $c";
let a++;
let b--;
echo "after let a++, let b-- : a : $a , b : $b";
let a+=6; let b+=6;
echo "after let a+=6 ,let b+=6 : a : $a , b : $b";
echo "\$[ a + b ] = $[ a + b ] ";
echo "\$((\$a + \$b)) = $(($a+$b))";
echo "expr \$a + \$b : `expr $a + $b`";
decimal=0.36
echo "$a * $decimal" | bc
echo "scale=4;11/3" | bc
echo "obase=2;ibase=10;43" | bc
echo "obase=10;ibase=2;100110" | bc
echo "sqrt(16)" | bc
echo "10^10" | bc
```

# read
```bash
#!/bin/bash
# 不需要回车回车
read -n 2 var
echo "enter $var"

# 以无回显的方式读取密码
read -s var2
echo "var2 : $var2";

# -p 以特定格式输出 -t 限定多少秒内输入
read -t 3 -p "do you love me ? ( Y / N ) : " answer
```

# md5sum 和 sha1sum 单向散列加密
```bash
cky@cky-pc:~/workspace/shell$ md5sum cky.sh
c225004cb6554e4ff84a31cc12204545  cky.sh
cky@cky-pc:~/workspace/shell$ md5sum cky.sh > cky.md5 # 将校验值存入文件
cky@cky-pc:~/workspace/shell$ cat cky.md5
c225004cb6554e4ff84a31cc12204545  cky.sh
cky@cky-pc:~/workspace/shell$ md5sum -c cky.md5 # 检验文件是否完整
cky.sh: 成功
```

# md5deep
```bash
cky@cky-pc:~/workspace/shell$ mkdir md5_dir
cky@cky-pc:~/workspace/shell$ touch md5_dir/aaa.txt
cky@cky-pc:~/workspace/shell$ touch md5_dir/bbb.txt
cky@cky-pc:~/workspace/shell$ echo "asdf bb cc" > md5_dir/ccc.txt
cky@cky-pc:~/workspace/shell$ md5deep -r1 md5_dir > md5_dir.md5
cky@cky-pc:~/workspace/shell$ sudo apt-get install hashdeep
程序“md5deep”尚未安装。 您可以使用以下命令安装：
sudo apt install hashdeep
cky@cky-pc:~/workspace/shell$ md5deep -rl md5_dir > md5_dir.md5
cky@cky-pc:~/workspace/shell$ cat md5_dir.md5
d41d8cd98f00b204e9800998ecf8427e  md5_dir/aaa.txt
d41d8cd98f00b204e9800998ecf8427e  md5_dir/bbb.txt
ae7a125ed9b9ea27e7d299386c48e816  md5_dir/ccc.txt

cky@cky-pc:~/workspace/shell$ md5sum -c md5_dir.md5 # 计算校验和
md5_dir/aaa.txt: 成功
md5_dir/bbb.txt: 成功
md5_dir/ccc.txt: 成功
```

# crypt 加密
```bash
cky@cky-pc:~/workspace/shell$ crypt cky951010 < cky.sh > cky_crypt
程序“crypt”尚未安装。 您可以使用以下命令安装：
sudo apt install mcrypt
cky@cky-pc:~/workspace/shell$ sudo apt-get install mcrypt

crypt cky951010 < cky.sh > cky_crypt # 使用口令给文件内容加密，加密后的文件是密文
crypt cky951010 -d <cky_crypt >cky_crypt_coutput.txt # 解密
```

# gpg 生成签名
```bash
gpg -c cky.sh # 生成签名，采用交互式读取口令
cky@cky-pc:~/workspace/shell$ ls |grep gpg
cky.sh.gpg

cky@cky-pc:~/workspace/shell$ gpg cky.sh.gpg
gpg: AES 加密过的数据
gpg: 以 1 个密码加密
File 'cky.sh' exists. 是否覆盖？(y/N) y
```

# base64
```bash
cky@cky-pc:~/workspace/shell$ base64 cky.sh > cky.sh.base64 # base64 加密
cky@cky-pc:~/workspace/shell$ cat cky.sh.base64
IyEvYmluL2Jhc2gKIyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0jCiMg6L+Z5Liq
6ISa5pys5YyF5ZCr5oiR5omA5a2m55qEc2hlbGznn6Xor4YKIyAtLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0jCiMg5b2T5YmN6L+b56iLUElECmVjaG8gIuW9k+WJjei/m+eoi1BJRCA6
ICQkIjsKZWNobyAi54i26L+b56iLUElEIDogJFBQSUQiOwplY2hvICLnlKjmiLdJRCA6ICRVSUQi
OwplY2hvICQhCmVjaG8gJF8KCmJhcigpewoJZWNobyAnYmFyIGNhbGxlZCc7CgljYWxsZXIgMAp9
CgpjYWxsX2Z1bmN0aW9uKCl7CgliYXI7Cn0KCmNhbGxfZnVuY3Rpb247CgoK

cky@cky-pc:~$ base64 -d cky.sh.base64 # base64 解密
#!/bin/bash
# ------------------------------------------------------------------------------------------#
# 这个脚本包含我所学的shell知识
# ------------------------------------------------------------------------------------------#
# 当前进程PID
```


# bzip2  bunzip2
- 适用于压缩大型二进制文件
- `-k` 保留原文件
```
➜  cky git:(master) bzip2 -k cky  压缩
➜  cky git:(master) ✗ ls -alhi cky*
17170663 -rwxr-xr-x 1 cky cky 32K 6月  13 16:11 cky
17175632 -rwxr-xr-x 1 cky cky 12K 6月  13 16:11 cky.bz2

➜  cky git:(master) ✗ rm cky
➜  cky git:(master) ✗ bunzip2 cky.bz2   解压文件
➜  cky git:(master) ls -alhi cky
17175667 -rwxr-xr-x 1 cky cky 32K 6月  13 16:11 cky
```

# gzip  gunzip
```
➜  cky git:(master) gzip cky
➜  cky git:(master) ✗ ls -l cky*
-rwxr-xr-x 1 cky cky 11914 6月  13 16:11 cky.gz
➜  cky git:(master) ✗ gunzip cky.gz
➜  cky git:(master) ls -l cky
-rwxr-xr-x 1 cky cky 32568 6月  13 16:11 cky
```

# zip unzip
- zip 的强大之处，在于它可以将整个目录压缩进单个文件
```
➜  cky git:(master) zip -r src.zip src/   递归压缩 src/ 目录下的文件 为 src.zip
  adding: src/ (stored 0%)
  adding: src/share.c (deflated 9%)
  ...
  ➜  cky git:(master) ✗ ls -l *.zip
  -rw-r--r-- 1 cky cky 4514 6月  16 12:46 src.zip

  ➜  cky git:(master) ✗ unzip src.zip   解压
```

# tar
- 归档命令，能将多个目录和文件归档进单个文件，再进行压缩
- `-c` 创建一个新的归档文件
- `-x` 从已有的归档文件中提取内容
- `-v` 显示处理过程
- `-f` 输出结果到文件或设备file
- `-z` 将输出重定向给gzip命令来压缩内容
```
➜  workspace tar -zcvf cky.tar.gz cky  # 归档压缩
➜  ~ tar -zxvf cky.tar.gz   # 解压到当前目录
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

# 命令的输入与输出
```bash
ls -l /tmp > tmp.msg     # >表示覆盖重定向 将 ls -l /tmp 的输出纪录到 /tmp.msg 中
date >> /tep.msg         # >>表示在末尾追加
grep 127 < /etc/hosts    # <输入重定向
ps aux | grep  apache2   # 管道| 将左边命令的输出作为右边命令的输入
ls  -l  `which touch`     # 命令替换符`` 将 which touch的输出作为 ls -l 的输入
```

# find
```bash
find # 在当前目录，寻找所有的子目录，子文件，列出来
find /etc # 在/etc 目录，寻找所有的子目录，子文件，列出来
find /etc -name "*.log" # 在/etc 目录，寻找所有匹配到 *.log 的子目录，子文件，列出来，-iname是忽略大小写，-name 不忽略
find /etc -user cky # 查找指定用户的文件，-nouser 查找没有所有者的文件
find /etc -mtime -10 # 查找10天内修改的文件 +10是10天之前 10 就是10天前当天，-atime 是最近被访问的时间 ,-ctime 是最后一次所有权被改变的时候
# -amin -mmin -cmin 是以分钟计数的
find /etc -size -25k # 查找小于 25k 的文件 25k 是等于 +25k 是大于 如果是Mb 的话 就是 +25M
find /etc -inum 345232 # 通过inode节点查找文件
find /etc -size +20k -a -size -50k  # -a 同时满足 找20k到50k之间到文件
find /etc -size -20k -o -size +50k # -o 找到小于20k 或者 大于50k的
find /etc -regex ".*\(\.py | \.sh\)$" # 使用正则表达式匹配, -iregex 让正则表达式忽略大小写
find /etc ! -name "*.txt" # ! 取反，表示查找所有不以 .txt 结尾的文件
find /etc -maxdepth 1 -name 'f*' # 最大遍历深度，到当前子目录，不再往下遍历
find /etc -mindepth 2 -name 'f*' # 最小遍历深度，从子目录的子目录开始遍历
find /etc -type d # 查找所有目录文件 -type f 是普通文件 -type l 是链接文件 -type c 是字符设备 -type s 是套接字 -type FIFO 是管道
find /etc -perm 644 # 查出权限为644的文件
```

```bash
cky@cky-pc:~/workspace/blog/web/md/web$ find -name '*js*' # 查文件名和目录名
./协议架构优化性能/js面试.md
./js
./js/cookie-js.md
./js/js对象类型检测.md
./js/js模块化.md
./node/nodejs.md

cky@cky-pc:~/workspace/blog/web/md/web$ find -path '*js*'  # 查整个路径包含的名
./协议架构优化性能/js面试.md
./js
./js/函数.md
./js/cookie-js.md
./js/内置对象.md
./js/正则.md
./js/上传文件.md
./js/OOP.md
./js/对象.md
./js/js对象类型检测.md
./js/基础.md
./js/闭包.md

cky@cky-pc:~/workspace/shell$ find ./ -name '*.sh' -exec cat -n {} \; | wc -l
474
cky@cky-pc:~/workspace/shell$ find . -name '*.sh' -exec cp {} ./sh \; # 将查询到的所有文件都拷贝到 ./sh 中

find . -name '*.sh' -exec commond.sh {} \; # 使用 shell 处理每个匹配到的文件

cky@cky-pc:~/workspace/shell$ find . -name '.git' -prune -o -path '*' # -name '.git' -prune 是要过滤的选项 , -o -path '*' 是实际要寻找的

```

updatedb
================================================================================
- 更新内置数据库 `/var/lib/mlocate`
- `locate  host`  基于内置文件数据库查找带有host字符的文件 遵循配置文件规则
```bash
# /etc/updatedb.conf
PRUNE_BIND_MOUNTS_ = "yes" # 开启搜索限制
PRUNEFS = # 搜索时 不搜索的文件系统
PRUNENAMES = # 搜索时 不搜索的文件类型
PRUNEPATHS = # 搜索时 不搜索的文件路径
```

which  ls
================================================================================
搜索系统命令,定位到`ls`命令的绝对路径；提供命令别名信息

whereis  ls
================================================================================
搜索系统命令,定位到`ls`命令的绝对路径；提供帮助文档信息

grep
================================================================================
- `grep "size" file.txt`   在file.txt中找包含size的行 (使用正则表达式匹配)
- `grep -nr "size" ./` 递归搜索当前目录下的所有文件 ,过滤出含有 `size` 的行，并显示它们的行数
- -i 忽略大小写
- -v 取反
- -n 显示行
- -r 递归


# sort
- `-f` 忽略大小写
- `-b` 忽略排序起始处的空白
- `-m` 将两个已排序数据文件合并
- `-g` 转换为浮点数后排序

```bash
sort file1.txt file2.txt > sorted.txt # 将两个文件里的内容排好序，存入另一个文件

sort -t: -k3 -n /etc/passwd # -t 以:为分隔符，-k 选择第3列作为排序依据
root:x:0:0:root:/root://usr/bin/zsh
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
...

du -sh * | sort -nr # -n 以数字大小排序，-r 反转排序方向
80K	lib
40K	src
32K	cky
20K	main.c
16K	include
12K	hello
4.0K	shell
4.0K	README.md
4.0K	Makefile
0	text.txt
```

# grep
- `grep [options] pattern [file]`
- `-v` 反向搜索,显示不匹配pattern的
- `-n` 显示行号
- `-c` 统计有多少匹配的行
- `-e` 指定多个pattern
- `-r` 递归

# wc
- 统计 行数 词数 字节数
```bash
➜  shell git:(master) wc < /etc/passwd
  46   78 2590
```

# uniq 去重
```bash
cat uniq.txt 
bash
foss
hack
hack

uniq uniq.txt # 去重
bash
foss
hack

uniq -u uniq.txt # 只显示唯一的行 
bash
foss

uniq -c uniq.txt # 统计出现行数
      1 bash
      1 foss
      2 hack
      1 

uniq -d uniq.txt # 找出重复的行
hack

uniq -s2 -w2 -c uniq_data.txt # -s 指定跳过两个字符，-w 指定只对比多少个字符
      1 u:01:gnu
      1 d:04:linux
      2 u:01:bash

uniq -z file.txt | xargs -0 rm # -z 给每行添加 \0 终结符，用以和 xargs -0 配合使用，使得每行被当做一个参数，而不是被空格隔开的好几个参数
```


# 排序
http://www.cnblogs.com/51linux/archive/2012/05/23/2515299.html
`sort -n`           将0-9识别为数字进行排序
`sort -t':' -k 3`   -t指定分割的字段，-k 3 表示根据分割的第三段排序
`sort -r`          逆序排列
例子：
我想让facebook.txt按照员工工资降序排序，如果员工人数相同的，则按照公司人数升序排序：
`$ sort -n -t' ' -k 3r -k 2 facebook.txt`
baidu     100     5000
google    110     5000
sohu      100     4500
guge      50      3000
从公司英文名称的第二个字母开始进行排序
`$ sort -t ' ' -k 1.2 facebook.txt`
baidu     100     5000
sohu      100     4500
google    110     5000
guge      50      3000
只针对公司英文名称的第二个字母进行排序，如果相同的按照员工工资进行降序排序
`$ sort -t ' ' -k 1.2,1.2 -k 3,3nr facebook.txt`
baidu  100  5000
google 110  5000
sohu   100  4500
guge   50   3000

# grep搜索文本
`grep pattern files`  搜索匹配pattern的内容
`grep -r pattern dir`  递归搜索dir中匹配parttern的内容
`grep -v  file.txt`  输出没匹配到文本的行
`grep -n  file.txt`  显示行号
`grep -E '219|216' data.doc` 匹配带有 219 或者 216的行
`egrep Posix_regexp file.txt` 使用POSIX拓展正则表达式
`px aux |grep ngnix` 搜索匹配到ngnix的行

# 去重
这个命令读取输入文件，并比较相邻的行。在正常情况下，第二个及以后更多个重复行将被删去
uniq  -c  显示输出中，在每行行首加上本行在文件中出现的次数

# cut 提取列 :基本被awk替代
- cut只擅长处理 以一个字符间隔 的文本内容
```bash
cut -c 5 # 指定切出第５个字符
who|cut -c 3-5,8 # 指定切出第3到第5个字符,第8个字符
cut -f 列数 -d 分割符 file.txt
grep "/bin/bash" /etc/passwd |grep -v "root" |cut -f 1 -t :
```

# sed 替换
```bash
sed '2d' example # 删除example文件的第二行
sed '2,$d' example # 删除example文件的第二行到末尾所有行
sed '$d' example # 删除example文件的最后一行
sed '/test/'d example # 删除example文件所有包含test的行 
sed 's/test/mytest/g' example # 在整行范围内把test替换为mytest, 如果没有g标记，则只有每行第一个匹配的test被替换成mytest
sed 's/^192.168.0.1/& localhost/' example # &符号表示替换换字符串中被找到的部份。所有以192.168.0.1开头的行都会被替换成它自已加 localhost，变成192.168.0.1 localhost
sed -n 's/\(love\)able/\1rs/p' example # love被标记为1，所有loveable会被替换成lovers，而且由于 -n /p ,只有替换的行会被打印出来 
sed 's#10#100#g' example # 不论什么字符，紧跟着s命令的都被认为是新的分隔符，所以，“#”在这里是分隔符，代替了默认的“/”分隔符。表示把所有10替换成100
sed -n '/test/,/check/p' example # 打印两个匹配行之间的所有行
sed -n '5,/^test/p' example # 打印从第五行开始到第一个包含以test开始的行之间的所有行
sed '/test/,/check/s/$/end/' example # 对于模板test和west之间的行，每行的末尾用字符串end替换
```


# 查询某个文件的所有git提交记录详情
```bash
git log mcs_db_install.sql | grep commit | awk '{print "git show " $2}' | sh >> mcs_db_install-git-show-log
```
# 统计某个文件夹下所有.php文件中代码行数
```bash
find ./ -name "*.php"|xargs cat|grep -v ^$|wc -l
```
# 删除windows系统编辑文本产生的不可见字符`^M`
```bash
touch love_tmp.c
sed 's/^M//' $1 > love_tmp.c
mv love_tmp.c $1
```
操作符	说明	举例

`^M` 的输入方法为 `Ctrl + v` 再加上 `Ctrl + m`
`cat -v love.c` 可用来查看一个文件，特殊字符也会显示出来











