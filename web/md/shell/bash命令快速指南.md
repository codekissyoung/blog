内建命令与外建命令
================================================================================
- 外建命令的特点是，它们是作为一个可执行程序放在$PATH变量所包含的目录中的。bash在执行这些命令的时候，都会进行fork(),exec()并且wait()。就是用标准的打开子进程的方式处理外部命令
- 但是内建命令不同，这些命令都是bash自身实现的命令，它们不依靠外部的可执行文件存在。只要有bash，这些命令就可以执行。典型的内建命令有cd、pwd等。


alias
================================================================================
```bash
alias ls='ls --color=auto'; 
# 给命令取别名，`./xxx.sh`运行shell脚本,，alias别名无效，`source`和`.`方式是起有效的，因为是在当前shell运行

# alias功能在交互打开的bash中是默认开启的，但是在bash脚本中是默认关闭的
shopt -s expand_aliases # 在脚本里启用alias功能


# 经典 alias 命令
alias rm='rm() { mv $@ ~/backup;};rm' # 配合函数，使用alias命令,将危险的rm命令，替换成mv命令
```

bg 在后台恢复暂停的作业
================================================================================
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

bind 将键盘序列绑定到一个readline函数或者宏
================================================================================
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

caller
================================================================================
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

compgen 为指定单词生成可能的补全匹配
================================================================================


complete 为指定的单词显示如何补全的
================================================================================


declare 声明一个变量/类型
================================================================================

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


Bash 外部命令
================================================================================

```bash
bzip2 # 加密
cat
chage
chfn
chgrp
chmod
chown
chpasswd
chsh
compress
cp
date
df
du
file
find
finger
free
grep
groupadd
groupmod
gzip
head
killall
less
link
ls
mkdir
more
mount
mv
nice
passwd
ps
pwd
renice
rm
rmdir
sort
stat
sudo
tail
touch
top
umount
uptime
useradd
userdel
usermod
vmstat
which
zip
```

pgrep 查出带有某字符串的进程的进程号
================================================================================
```bash
cky@cky-pc:~$ pgrep -l ssh
1895 ssh-agent
24486 sshd
```

tr 替换 去重 删除
================================================================================
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


shell 数学计算
================================================================================
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

read
================================================================================
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

md5sum 和 sha1sum 单向散列加密
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ md5sum cky.sh 
c225004cb6554e4ff84a31cc12204545  cky.sh
cky@cky-pc:~/workspace/shell$ md5sum cky.sh > cky.md5 # 将校验值存入文件
cky@cky-pc:~/workspace/shell$ cat cky.md5 
c225004cb6554e4ff84a31cc12204545  cky.sh
cky@cky-pc:~/workspace/shell$ md5sum -c cky.md5 # 检验文件是否完整
cky.sh: 成功
```

md5deep
================================================================================
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

crypt 加密
================================================================================

```bash
cky@cky-pc:~/workspace/shell$ crypt cky951010 < cky.sh > cky_crypt
程序“crypt”尚未安装。 您可以使用以下命令安装：
sudo apt install mcrypt
cky@cky-pc:~/workspace/shell$ sudo apt-get install mcrypt 

crypt cky951010 < cky.sh > cky_crypt # 使用口令给文件内容加密，加密后的文件是密文
crypt cky951010 -d <cky_crypt >cky_crypt_coutput.txt # 解密
```

gpg 生成签名
================================================================================
```bash
gpg -c cky.sh # 生成签名，采用交互式读取口令
cky@cky-pc:~/workspace/shell$ ls |grep gpg
cky.sh.gpg

cky@cky-pc:~/workspace/shell$ gpg cky.sh.gpg
gpg: AES 加密过的数据
gpg: 以 1 个密码加密
File 'cky.sh' exists. 是否覆盖？(y/N) y
```

base64
================================================================================

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





















































