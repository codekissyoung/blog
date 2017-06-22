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

shell编程要注意什么
================================================================================
- 命令从上而下，从左至右分析和执行
- 命令、参数间的多个空白会被忽略
- 空白行也会被忽略
- 如果读取到一个Enter符号，就尝试执行该行命令
- 如果一行代码太多，可以用[enter]来进行扩展
- #作为注释


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
    echo -n "This is a simple test "
}
# 调用函数
printit
```

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
for ((i=1;i<=$num;i=i+1))
do
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

# `jobs` 程序栈管理
```
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

# 文件搜寻
`updatedb`  更新内置数据库 `/var/lib/mlocate`
`locate  host`  基于内置文件数据库查找带有host字符的文件 遵循`/etc/updatedb.conf`配置文件规则
```
PRUNE_BIND_MOUNTS_ = "yes" # 开启搜索限制
PRUNEFS = # 搜索时 不搜索的文件系统
PRUNENAMES = # 搜索时 不搜索的文件类型
PRUNEPATHS = # 搜索时 不搜索的文件路径
```
`find  /etc  -iname "*.log"`  通配符匹配,在`/etc`里面查找log结尾的文件
```
统配符是完全匹配 * 匹配任意多个字符 ?匹配单个字符 [abcd]匹配abcd任意一个字符
-iname  # 不区分大小写
-user "cky" # 过滤 只搜索该用户的文件
-nouser # 查找没有所有者的文件
-mtime -10 # 查找10天内修改的文件 +10是10天之前 10 就是10天前当天
-size -25k # 查找小于 25k 的文件 25k 是等于 +25k 是大于 如果是Mb 的话 就是 +25M
-inum 通过inode节点查找文件
-a # 同时满足
find /etc -size +20k -a -size -50k # 找 20k到50k之间到文件
-o # 或者
find /etc -size －20k -o -size ＋50k ＃找到小于20k 或者 大于50k的
-exec ls -al {} /;将搜索的结果使用 ls -al 执行
```
`which  ls` 搜索系统命令,定位到`ls`命令的绝对路径；提供命令别名信息
`whereis  ls` 搜索系统命令,定位到`ls`命令的绝对路径；提供帮助文档信息
`grep "size" file.txt`   在file.txt中找包含size的行 (使用正则表达式匹配)
`grep -nr "size" ./` 递归搜索当前目录下的所有文件 ,过滤出含有 `size` 的行，并显示它们的行数
```
-i 忽略大小写
-v 取反
-n 显示行
-r 递归
```
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
```
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
```
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

`mount [-t] [-o] 设备文件名 挂载点`
```
-t 文件系统 ext3 ext4 iso9660
-o 特殊选项
```

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

# 变量
`echo "I am good at ${skill}Script"` #引用变量要加{}

# 环境变量
普通用户启动shell加载的配置文件流程
```
/etc/profile
/etc/profile.d/*.sh
/etc/bashrc
~/.bash_profile   # ~ 只对当前用户生效的配置文件
~/.bashrc
```
`source .bashrc` 修改了配置文件，用这个命令重新使配置生效
#PATH
命令执行路径
```
export PATH=$PATH:/usr/locar/new/bin
```
给PATH增加一个路径

# 特殊变量
`$*` 和 `$@` 都表示传递给函数或脚本的所有参数，不被双引号`" "`包含时，都以`"$1" "$2" … "$n" `的形式输出所有参数。
但是当它们被双引号`" "`包含时，`"$*"`会将所有的参数作为一个整体，以`"$1 $2 … $n"`的形式输出所有参数；`"$@"` 会将各个参数分开，以`"$1" "$2" … "$n" `的形式输出所有参数

# 提示用户输入信息
`read  [option] var_name`
[option]
-t  等待用户输入的时间
-p  提示信息
-s  隐藏输入的数据
-n 2 接收到2个字符，shell就继续执行

# 数值运算
`dd=$(($a+$b))` 推荐使用



# 通配符
它是完全匹配，主要用于匹配文件名
`*`  匹配任意字符
`?`  匹配一个字符
`[]` 匹配[]里面的一个字符

# 正则表达式
它是包含匹配，主要用于文件内容
包含匹配的意思是：只要匹配到字符，这一整行都要列出来


文件测试运算符列表
操作符	说明	举例
-b file	检测文件是否是块设备文件，如果是，则返回 true。	[ -b $file ] 返回 false。
-c file	检测文件是否是字符设备文件，如果是，则返回 true。	[ -b $file ] 返回 false。
-d file	检测文件是否是目录，如果是，则返回 true。	[ -d $file ] 返回 false。
-f file	检测文件是否是普通文件（既不是目录，也不是设备文件），如果是，则返回 true。	[ -f $file ] 返回 true。
-g file	检测文件是否设置了 SGID 位，如果是，则返回 true。	[ -g $file ] 返回 false。
-k file	检测文件是否设置了粘着位(Sticky Bit)，如果是，则返回 true。	[ -k $file ] 返回 false。
-p file	检测文件是否是具名管道，如果是，则返回 true。	[ -p $file ] 返回 false。
-u file	检测文件是否设置了 SUID 位，如果是，则返回 true。	[ -u $file ] 返回 false。
-r file	检测文件是否可读，如果是，则返回 true。	[ -r $file ] 返回 true。
-w file	检测文件是否可写，如果是，则返回 true。	[ -w $file ] 返回 true。
-x file	检测文件是否可执行，如果是，则返回 true。	[ -x $file ] 返回 true。
-s file	检测文件是否为空（文件大小是否大于0），不为空返回 true。	[ -s $file ] 返回 true。
-e file	检测文件（包括目录）是否存在，如果是，则返回 true。	[ -e $file ] 返回 true。


#查询某个文件的所有git提交记录详情
```
git log mcs_db_install.sql|grep commit|awk '{print "git show " $2}'|sh >> mcs_db_install-git-show-log
```
#统计某个文件夹下所有.php文件中代码行数
```
find ./ -name "*.php"|xargs cat|grep -v ^$|wc -l
```
#删除windows系统编辑文本产生的不可见字符`^M`
```
touch love_tmp.c
sed 's/^M//' $1 > love_tmp.c
mv love_tmp.c $1
```
`^M` 的输入方法为 `Ctrl + v` 再加上 `Ctrl + m`
`cat -v love.c` 可用来查看一个文件，特殊字符也会显示出来

# bash 控制台颜色
打印全部颜色
```
#!/bin/bash
for STYLE in 0 1 2 3 4 5 6 7; do
  for FG in 30 31 32 33 34 35 36 37; do
    for BG in 40 41 42 43 44 45 46 47; do
      CTRL="\033[${STYLE};${FG};${BG}m";
      echo -en "${CTRL}";
      echo -n "${STYLE};${FG};${BG}";
    done
  done
done
echo -e "\e[1;34mThis is a blue text.\e[0m"
```
参考 [Bash: Using Colors](http://webhome.csc.uvic.ca/~sae/seng265/fall04/tips/s265s047-tips/bash-using-colors.html)

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
cut -f 列数 -d 分割符 file.txt
例子：grep "/bin/bash" /etc/passwd |grep -v "root" |cut -f 1 -t :

# awk   文本操作的神器
awk -F: -f awk_script  file.txt  以 : 分割字符段；每段依次以 $n 表示

awk 内置环境变量
ARGC               命令行参数个数
ARGV               命令行参数排列
ENVIRON            支持队列中系统环境变量的使用
FILENAME           awk浏览的文件名
FNR                浏览文件的记录数
FS                 设置输入域分隔符，等价于命令行 -F选项
NF                 浏览记录的域的个数
NR                 已读的记录数
OFS                输出域分隔符
ORS                输出记录分隔符
RS                 控制记录分隔符
$0变量是指整条记录。$1表示当前行的第一个域,$2表示当前行的第二个域,......以此类推

awk 编程
基本写法
awk '
   BEGIN { actions }
   /pattern/ { actions }
   /pattern/ { actions }
   END { actions }
' files

awk中的条件语句，循环语句都抄的c语言，支持while、do/while、for、break、continue，这些关键字的语义和C语言中的语义完全相同。
数组：awk中数组的下标可以是数字和字母，数组的下标通常被称为关键字(key)。值和关键字都存储在内部的一张针对key/value应用hash的表格里。由于hash不是顺序存储，因此在显示数组内容时会发现，它们并不是按照你预料的顺序显示出来的。数组和变量一样，都是在使用时自动创建的，awk也同样会自动判断其存储的是数字还是字符串。一般而言，awk中的数组用来从记录中收集信息，可以用于计算总和、统计单词以及跟踪模板被匹配的次数等等。

关系运算符：==( 相等) 、!=( 不等) 、<( 小于) 、<=( 小于等于) 、>( 大于) ，以及>=(大于等于》。
1为真，0 为假,字符串较短的会定义为小于较长的那个，因此，"A"< "AA" 的值为真

awk工作流程是这样的：先执行BEGING，然后读取文件，读入有/n换行符分割的一条记录，然后将记录按指定的域分隔符划分域，填充域，$0则表示所有域,$1表示第一个域,$n表示第n个域,随后开始执行模式所对应的动作action。接着开始读入第二条记录······直到所有的记录都读完，最后执行END操作。

`awk 'BEGIN {count=0;print "[start]user count is ", count} {count=count+1;print $0;} END{print "[end]user count is ", count}' /etc/passwd`

字符串转数字：变量通过"+"连接运算，自动强制将字符串转为整型，非数字变成0
awk 'BEGIN{a=1;b=2;c=a+b;print c}'  #输出 3
数字转字符串：只需要将变量与""符号连接起来
awk 'BEGIN{a=1;b=2;c=a+b;print c}'  #输出 12

例子
显示最近登录的五个账号
last -n 5 | awk  '{print $1}'

如果只是显示/etc/passwd的账户
`cat /etc/passwd |awk  -F ':'  '{print $1}'`

搜索/etc/passwd有root关键字的所有行：pattern的使用示例，匹配了pattern(这里是root)的行才会执行action(没有指定action，默认输出每行的内容)
`awk -F: '/root/' /etc/passwd`     # 输出 root:x:0:0:root:/root:/bin/bash

搜索/etc/passwd有root关键字的所有行，并显示对应的shell
`awk -F: '/root/{print $7}' /etc/passwd`
/bin/bash

显示/etc/passwd的账户
`awk -F ':' 'BEGIN {count=0;} {name[count] = $1;count++;}; END{for (i = 0; i < NR; i++) print i, name[i]}' /etc/passwd`

删除用户zdd的所有文件，注意-rf后面有一个空格
`ls -l | awk '/zdd/{print "rm -rf " $9} | sh `

将文件中的几行输出合并成一行显示
awk '{if (NR%2==0){print $0} else {printf"%s ",$0}}' aa.txt
之前：
192.168.1.17
down
192.168.1.103
open
192.168.1.221
之后：
192.168.1.17  down
192.168.1.103 open
192.168.1.221 open

BEGIN可以用来打印表头或者列名等，如下
BEGIN{
    -F":"
    printf "----------------------------------------------------------------\n"
    printf "%-20s%-16s  Jan  |  Feb  |  Mar  |Total Donated\n ","NAME","PHONE"
    printf "----------------------------------------------------------------\n"
}

awk 程序例子
```bash
BEGIN{user_id="0";amount=0;register_day="unkown";login_days=0;last_login_day="unkown"}
{
    if($1""!=user_id){
        if(user_id!=0){
            print user_id,register_day,last_login_day,login_days,amount;
        }
        user_id = $1"";
        register_day = $2;
        amount = $3;
        login_days = 1;
    }else{
        last_login_day = $2;
        amount = amount + $3;
        login_days++;
    }
}
END{print $1,register_day,last_login_day,login_days,amount;}
```

参考：
http://www.cnblogs.com/softwaretesting/archive/2012/02/02/2335332.html
http://blog.csdn.net/wzhwho/article/details/5513791
http://blog.sina.com.cn/s/blog_7b9ace5301014q8o.html
