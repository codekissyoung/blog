# shell编程要注意什么
- 命令从上而下，从左至右分析和执行
- 命令、参数间的多个空白会被忽略
- 空白行也会被忽略
- 如果读取到一个Enter符号，就尝试执行该行命令
- 如果一行代码太多，可以用[enter]来进行扩展
- `#` 作为注释

# 打印
```bash
echo "带换行的";
echo -n "不带换行的: ";
```

# 环境变量
- 在shell脚本中可以使用从父shell(执行该脚本的shell)中的环境变量
```bash
echo "常用的环境变量: ";
echo "HOME     : ${HOME}";
echo "UID      : ${UID}";
echo "USER     : ${USER}";
```

# 变量
- 变量名字区分大小写
- 声明或者赋值时，变量、等号和值之间不能出现空格
- `${变量名}` 是引用变量的意思
- `=` 两边不能有空格
- `>` 作为大于号时要转义，否则默认作为重定向处理
```bash
testing=`date` # 声明或者赋值
echo ${testing} # 使用该变量
unset testing # 删除该变量
```

# . 与 source
- 两者是等价的,从文件中读取并执行命令，无论该文件是否都有可执行权限都能够正确的执行,并且是在当前shell下执行，而不是产生一个子shell来执行
- `./filename.sh`去执行一个文件是在当前shell下产生一个子shell去执行的
    ```bash
    for i in /etc/profile.d/*.sh ; do
        if [ -r "$i" ]; then
            . $i
        fi
    done
    ```

# :
```bash
if [ "$i" -ne 1 ];then
    : # 该命令什么都不做，但执行后会返回一个正确的退出代码，即exit 0
else
    echo "$i is equal 1"
fi
```

# 数学运算
- 数学计算对于shell来说是很麻烦的一件事情
- `expr 1 + 5` 和 `expr 5 \* 2` 太麻烦了(`*`是特殊字符 要转义)
- 推荐使用方`$[operation]`的方式使用
- bash shell 只支持整数运算 , zsh 提供浮点数运算

```bash
var1=10
var2=$[$var1 * 2]
var3=20
var4=$[$var1 * ($var2 - $var3)]
```

# bc 运算器来实现浮点数运算
```bash
#!/bin/bash
var1=100
var2=45
var3=`echo "scale=4; $var1 / $var2" | bc` # scale=4; #是设置bc计算器使用4位小数
echo $var3
```

# exit
- 退出码 , 0是正常退出,错误码　1 - 255
- `echo $?` 输出上一个程序执行后的退出码
```bash
exit 5
```

# if then fi
- 测试命令是否执行成功，根据 $? 的值来判断,$? = 0 则为真
    ```bash
    if command; then
        echo "命令执行成功";
    fi
    ```
- 测试命令,test 可以进行数值比较，字符串比较，文件比较
    ```bash
    if test condition; then
        command;
    fi
    简写:
    if [ condition ]; then  # [] 两边的空格是必要的
        commands;
    fi
    ```

```bash
#!/bin/bash
# date 命令执行成功了 $? = 0
if date > /dev/null; then
    echo "date 命令执行成功了"
fi

# grep 没有搜寻到用户 $? = 1
if grep codekissyoung /etc/passwd;then
    echo "用户codekissyoung存在";
elif grep cky /etc/passwd > /dev/null;then
    echo "cky 存在";
else
    echo "用户codekissyoung不存在";
fi

# 判断数字大小 只限于整数
a=10
b=10
if [ $a -eq $b ]; then
   echo "a 等于 b"
elif [ $a -gt $b ]; then
   echo "a 大于 b"
elif [ $a -lt $b ]; then
   echo "a 小于 b"
else
   echo "没有符合的条件"
fi


# 判断字符串相等
if [ "code" = "cky" ]; then  # 记住是用一个 = 来判断是否相等
    echo "code 不等于　cky";
fi

# 判断字符存在
var="变量var"
if [ -n $var ]; then
    echo "$var存在";
fi

# 字符串比较大小
var1="abd"
var2="abc"
if [ $var1 \> $var2 ];then
    echo "$var1 大于 $var2";
fi

# 判断文件
# -e 判断路径是否存在
# -d 判断路径是否存在 并且是目录
# -f 判断路径是否存在 并且是文件
# -s 判断文件是否不为空
# -r -w -x 判断文件是否 可读 可写 可执行
# -O 判断执行者是否是文件的属主
# file1 -nt file2  ,file1 是否比 file2 更新, 镜像: file1 -ot file2
if [ -d "$HOME" ]; then
    echo "$HOME 存在";
fi
```

# && 与 || 组合条件
```
if [ -d $HOME ] && [ -w "$HOME" ]; then
    echo "$HOME 存在并且可读";
fi
```

# () 与 {}
- {} 和()类似，也是将多个命令组合在一起
- ()是在产生的子shell下执行，当在()中赋值的变量，影响的只是自身的子shell，而不能将该值赋给父shell
- {}是在当前的shell下执行，在{}中赋值的变量，因为就在当前的shell执行的，所以就能改变原来变量的值
- ()里面两边可以不使用空格，{}里面两边必须使用空格，且最后一个命令也需要以“；”结尾
```bash
➜  shell git:(master) ✗ A=123
➜  shell git:(master) ✗ (A=code;echo $A);echo $A
code
123
➜  shell git:(master) ✗ B=123
➜  shell git:(master) ✗ {B=code;echo $B};echo $B
code
code
```

# (())
- 专门用来做数值运算
```bash
➜  shell git:(master) ✗ ((i=1+99));echo $i
100
➜  shell git:(master) ✗ i=99;((i++));echo $i
100
➜  shell git:(master) ✗ echo $((2**3))
8
```

# [[]]
- 相当于 [] 的升级版
```
数字测试： -eq -ne -lt -le -gt -ge，[[ ]]同 [ ]一致
文件测试： -r、-l、-w、-x、-f、-d、-s、-nt、-ot，[[ ]]同 [ ]一致
字符串测试： > < =(同==) != -n -z，不可使用“<=”和“>=”，[[ ]]同 [ ]一致，但在[]中，>和<必须使用\进行转义，即\>和\<
逻辑测试： []为 -a -o ! [[ ]] 为&& || !
数学运算： [] 不可以使用 [[ ]]可以使用+ - * / %
组合： 均可用各自逻辑符号连接的数字（运算）测试、文件测试、字符测试
```

# case
```bash
case variable in
pattern | pattern1 | pattern2 )
    command1 ;;
pattern3)
    command2 ;;
*)
    default commond ;;
esac
```

```bash
#!/bin/bash
a=code
case $a in
"codekissyoung" | "caokaiyan" | "hehe" )
    echo "codekissyoung or caokaiyan or hehe";;
"code" )
    echo "a 是code";;
*)
    echo "其他";;
esac
```

# for
```bash
for var in list
do
    commands
done
```
- `list`变量是使用IFS环境变量的值来分割的，正常情况`IFS=' '$'\t'$'\n'`,表示list是使用\t \n 空格来分割的，忽略数量，一个空格和两个空格都是一样的,$符号修饰是不可少的

    ```bash
    IFS.OLD=$IFS
    IFS=$'\n' # 修改IFS默认值
    # commands with new IFS
    IFS=$IFS.OLD # 恢复IFS默认值  

    # eg .
    data="name,sex,rollno,location"; # CSV 数据
    IFS.OLD=$IFS
    IFS=, # 将IFS 设置为 ,
    for item in $data;do
        echo "item : $item";
    done;
    IFS=$IFS.OLD  # 恢复原值
    ```

- list 可能的参数
    ```bash
    list="abc bcd cdf"
    for var in $list ; do
        echo "var : $var"
    done

    for var in `cat /etc/passwd`; do
        echo "$var";
    done

    for script in /etc/*.d /etc/*.conf; do # 遍历 /etc/ 目录 , in 后面可以跟多个目录,它们是通配符，空格隔开就好
        echo $script
    done
    ```

- c 语言形式的for
```bash
    for (( i=0; i<10; i++ )){
        commands;
    }
```



# while
- [] 里面的用法跟 if 的一样
```bash
while [];do
    commands
done
```

# until
- 跟while相反，条件符合才停止
```bash
until [];do
    commands
done
```

# break
- 用在　for ,while , until 里，跳出循环
    ```bash
    while [];do
        if [];then
            break;
        fi
        commands
    done;
    ```

# continue
- 跳过这次循环,将上例中的break换成continue就好

# done
- done 可以选择将循环里面的输出的内容重定向到文件，或者通过管道传递给其他命令

```bash
for var in $lists; do
    commands;
done > output.txt

for var in $lists;do
    commands;
done | sort -nr
```

# 生成序列
```bash
cky@cky-pc:~/workspace/blog/web/md/linux/shell$ echo {1..40}
1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 35 36 37 38 39 40
cky@cky-pc:~/workspace/blog/web/md/linux/shell$ echo {a..z}
a b c d e f g h i j k l m n o p q r s t u v w x y z
```

```bash
for i in {a..z};do
    commands;
done;
```

普通数组
================================================================================
```bash
#!/bin/bash
arr=(23 34 56 测试 第五个值 67 76 54 35) 
echo ${arr[0]}
index=4
echo ${arr[$index]};
echo ${arr[*]}
echo ${arr[@]}
echo ${#arr[*]} # 数组个数
# 23
# 第五个值
# 23 34 56 测试 第五个值 67 76 54 35
# 23 34 56 测试 第五个值 67 76 54 35
# 9
```


关联数组 (Bash 4.0引入)
================================================================================
```bash
#!/bin/bash
declare -A ass_arr; # 定义
ass_arr=([apple]='1.00' [orange]='3.00'); # 初始化
ass_arr[banana]='4.00'; # 单个赋值
echo "the price of apple is ${ass_arr[apple]}"; # 使用索引数组
echo ${!ass_arr[*]} # 获取所有的索引
echo ${!ass_arr[@]} # 同上
# the price of apple is 1.00
# apple banana orange
# apple banana orange
```

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
if [ 判断1 ]; then
    执行内容
##多重判断
elif [ 判断2 ]; then
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
while [ condition ]
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

# `&&` 与 `||` 控制程序执行流程
```bash
# 前面命令执行成功后，才执行后面命令
sudo service apache2  stop && sudo  service apache2  start
# 前面命令执行失败后，后面命令才执行
service apache2 restart || sudo service apache2 restart
```





# $0 $1 $2 $3
- `./my_shell_script 10 20` 执行后，脚本里面 ,$0的值是`./my_shell_script` ,$1 的值是10 ,$2的值是20,依次类推
- 判断$1等是否存在， `if [ -n "$1" ]`

# basename
- 从路径里面获取脚本名称
```bash
name=`basename $0`
echo $name # my_shell_script
```

# `$#`
- 参数个数

# $* 与 $@
- `$*` 把所有参数当做一个整体
- `$@` 把所有参数当做一个数组，可以遍历的

# shift
- shift 命令将参数左移动，$1的原先的值丢弃，$2的值变为$1的值，依次类推
```bash
while [ -n "$1" ]; do
    commands;
    shift
done
```

# 依次处理每个参数

```bash
while [ -n "$1" ] ;do
    case "$1" in
    first)
        echo "first 参数";;
    second)
        echo "second 参数";;
    third)
        echo "third 参数";;
    *)
        echo "处理其他参数";;
    esac
    shift
done
```


# 依次处理每个带值的参数
```bash
while [ -n "$1" ] ;do
    case "$1" in
        cut)
            # 获取cut后面的值
            value="$2";
            echo "cut处理$2";
            shift;;
        add)
            echo "add 参数";;
        *)
            echo "其他参数";
    esac
    shift
done
```


getopts
================================================================================
- shell内置

```
➜  web git:(master) ✗ type getopts
getopts is a shell builtin
```


getopt
================================================================================



read
================================================================================
- -t 参数来限制用户的输入时间
- -s 参数可以不显示用户的输入

```bash
#!/bin/bash
# read -p "提示语句" variable1 variable2 variableN 
read -t 3 -p "do you love me ? ( Y / N ) : " answer

if [ -n "$answer" ];then
    :
else
    echo "... no answer!";
fi

case $answer in
    Y | y)
        echo "i love you too";;
    N | n)
        echo "fine , thank you ";;
    *)
        echo "unkown answer";;
esac
```


`$`符号
================================================================================
```bash
cky@cky-pc:~$ var=abckefg
cky@cky-pc:~$ echo ${#var} # 变量长度
7

cky@cky-pc:~$ echo $SHELL # 环境变量
/bin/bash

if [ $UID -eq 0 ];then # 环境变量 判断root用户
    echo "root用户";
fi
```

eval 将字符串当做命令执行
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ NAME=codekissyoung
cky@cky-pc:~/workspace/shell$ eval echo $NAME # 等价于 echo $NAME
codekissyoung

cky@cky-pc:~/workspace/shell$ echo "hi code!" > hi.txt
cky@cky-pc:~/workspace/shell$ cat hi.txt 
hi code!
cky@cky-pc:~/workspace/shell$ my_hi="cat hi.txt"
cky@cky-pc:~/workspace/shell$ echo $my_hi
cat hi.txt
cky@cky-pc:~/workspace/shell$ eval $my_hi
hi code!

cky@cky-pc:~/workspace/shell$ cat test_eval.sh 
#!/bin/bash
echo "最后一个参数 : $( eval echo $# )"
echo "最后一个参数 : $( eval echo \$$# )"

cky@cky-pc:~/workspace/shell$ ./test_eval.sh 
最后一个参数 : 0
最后一个参数 : ./test_eval.sh
cky@cky-pc:~/workspace/shell$ ./test_eval.sh a b c d
最后一个参数 : 4
最后一个参数 : d
```

`$()` 等价于反引号 命令替换
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ echo the last sunday is $(date -d "last sunday" +%Y-%m-%d)
the last sunday is 2017-06-25
```

`${}` 用作变量替换
================================================================================
```bash
A=B
echo $AB # 空
echo ${A}B # BB
```

xargs 将输入转化为命令行参数
================================================================================
- 有些命令只能以命令行参数的形式接受收据，而无法通过stdin接受数据流。在这种情况下，我们没法用管道来提供那些只有通过命令行参数才能提供的数据
- xargs擅长将标准输入数据转换成命令行参数
- -d 选项，指明定界符
- -n 选项，指明每行最大的参数数量
- xargs默认将空格作为定界符。xargs没有指定参数时，默认能将换行符替换成空格。
- 很多文件名中都可能会包含空格符，而xargs很可能会误认为它们是定界符(例如，hell text.txt会被xargs误认为hell和text.txt)
- xargs 不能为多组命令提供参数

```bash
cky@cky-pc:~/workspace/shell$ cat xargs.txt 
12 22 3 3 56
32 23 45 6
32 2 3
4 5
90
cky@cky-pc:~/workspace/shell$ cat xargs.txt  | xargs 
12 22 3 3 56 32 23 45 6 32 2 3 4 5 90
cky@cky-pc:~/workspace/shell$ cat xargs.txt  | xargs -n3
12 22 3
3 56 32
23 45 6
32 2 3
4 5 90

cky@cky-pc:~/workspace/shell$ echo "splitXsplitXsplitXsplit" | xargs -d X
split split split split

cky@cky-pc:~/workspace/shell$ echo "splitXsplitXsplitXsplit" | xargs -d X -n2
split split
split split

cky@cky-pc:~/workspace/shell$ cat cecho.sh 
#!/bin/bash
echo '处理' $* 
cky@cky-pc:~/workspace/shell$ ./cecho.sh aaa bbb ccc
处理 aaa bbb ccc 
cky@cky-pc:~/workspace/shell$ cat args.txt 
aaa
bbb
ccc

cky@cky-pc:~/workspace/shell$ cat args.txt | xargs -n 1 ./cecho.sh 
处理 aaa 
处理 bbb 
处理 ccc 

cky@cky-pc:~/workspace/shell$ cat args.txt | xargs -I {} ./cecho.sh -p {} -l
处理 -p aaa -l
处理 -p bbb -l
处理 -p ccc -l

cky@cky-pc:~/workspace/shell$ find . -name '*.sh' | xargs -I {} cp {} sh_dir # 结合find和xargs使用
cky@cky-pc:~/workspace/shell$ ls sh_dir/
arg_exec.sh           arr.sh        bc.sh     cky_call.sh  color.sh    ifelse.sh  math.sh         prepend.sh  read.sh      son_shell.sh    test_eval.sh    update-shell.sh
arg_with_val_exec.sh  assoc_arr.sh  cecho.sh  cky.sh       getopts.sh  let.sh     mysql_shell.sh  printf.sh   set_path.sh  test-ctrl-c.sh  update-blog.sh  var_exchange.sh

# 定界符的例子
cky@cky-pc:~/workspace/shell$ find -name '*.info'
./test space.info
cky@cky-pc:~/workspace/shell$ find -name '*.info' | xargs -n 1
./test
space.info
cky@cky-pc:~/workspace/shell$ find -name '*.info' -print0 | xargs -n 1
xargs: 警告: 输入中有个 NUL 字符。它不能在参数列表中传送。您是想用 --null 选项吗？
./test
space.info
cky@cky-pc:~/workspace/shell$ find -name '*.info' -print0 | xargs -0 -n 1
./test space.info
cky@cky-pc:~/workspace/shell$ find -name '*.info' -print0 | xargs --null -n 1
./test space.info


# 在一条语句里执行命令组的例子
cat files.txt | (while read arg;do cat $arg;done) # 等价 cat files.txt | xargs -I {} cat {}
cmd0 | (cmd1;cmd2;cmd3) | cmd4 # 利用子shell

```


# 变量类型
================================================================================
- 全局环境变量，在当前shell可用，子shell也会继承父shell的环境变量
- 当前shell局部变量,子shell不能访问到
- 函数局部变量，只在函数内部能访问到

# 常用的环境变量
```bash
PATH            决定了shell将到哪些目录中寻找命令或程序
ROOTPATH        这个变量的功能和PATH相同，但它只罗列出超级用户（root）键入命令时所需检查的目录。
HOME            当前用户主目录
USER            查看当前的用户
LOGNAME         查看当前用户的登录名。
UID             当前用户的识别字，取值是由数位构成的字串。
SHELL           是指当前用户用的是哪种Shell。
TERM            终端的类型。
PWD             当前工作目录的绝对路径名，该变量的取值随cd命令的使用而变化。
MAIL            是指当前用户的邮件存放目录。
HISTSIZE        是指保存历史命令记录的条数
HOSTNAME        是指主机的名称，许多应用程序如果要用到主机名的话，通常是从这个环境变量中来取得的。
PS1             是基本提示符，对于root用户是#，对于普通用户是$，也可以使用一些更复杂的值。
PS2             是附属提示符，默认是">"。可以通过修改此环境变量来修改当前的命令符
IFS             输入域分隔符。当shell读取输入时，用来分隔单词的一组字符，它们通常是空格、制表符和换行符。
```

# printenv
- 打印出当前shell的全局环境变量
- 全局环境变量在当前shell会话的子进程中也是可见的，局部变量只在当前shell可见

```bash
➜  ~ printenv
XDG_SEAT_PATH=/org/freedesktop/DisplayManager/Seat0
XDG_CONFIG_DIRS=/etc/xdg/xdg-ubuntu:/etc/xdg
LC_TELEPHONE=zh_CN.UTF-8
LANG=zh_CN.UTF-8
...
➜  ~ echo $HOME  输出全局变量
/home/cky
```


# set
- 输出当前进程的所有变量
```bash
cky@cky-pc:~/workspace/shell$ set
BASH=/bin/bash
BASHOPTS=checkwinsize
...
```

# 设置局部变量
- 注意 等号两边都不能有空格，有空格的话，shell会把test当做命令来处理

```bash
➜  ~ test='设置局部变量'
➜  ~ echo $test
设置局部变量
```



# 设置全局变量
```bash
➜  shell git:(master) ✗ export test
➜  shell git:(master) ✗ cat echo_test
#!/bin/bash
echo $test
➜  shell git:(master) ✗ ./echo_test
设置局部变量
```

# 删除变量
- 局部变量删除就删除了，但是在子进程中删除全局变量，并不影响父进程中的该全局变量

```bash
➜  shell git:(master) ✗ unset test
➜  shell git:(master) ✗ echo $test

➜  shell git:(master) ✗
```

# shell 种类
- 登录shell
- 如果`.bash_profile`和`.bash_login`存在的话，就不会执行`.profile`了
    ```bash
        /etc/profile
        $HOME/.bash_profile
        $HOME/.bash_login
        $HOME/.profile
    ```
- 非登录的 交互式 shell , 比如在登录shell里面执行 bash 启动一个新的子shell
    ```bash
        /etc/profile
        $HOME/.bashrc
    ```
- 执行脚本 非交互式shell

# 重定向
```bash
#!/bin/bash
# 在workspace目录下面查找 read.sh , 错误输出重定向到标准输出，然后再一起重定向到find.log
find /home/cky/workspace read.sh > find.log 2>&1
find /home/cky/workspace read.sh >& find.log　# 同上面功能一样　简写版
```

# 格式化打印
```bash
#!/bin/bash
printf "%-5s %-18s %-4s\n" NO Name Mark
printf "%-5s %-18s %-4.2f\n" 1 codekissyoung 11.07
printf "%-5s %-18s %-4.2f\n" 2 caokaiyan 12.09
printf "%-5s %-18s %-4.2f\n" 3 "yan code" 01.23
```


# 彩色字体输出
```bash
#!/bin/bash 
#下面是字体输出颜色及终端格式控制  
#字体色范围：30-37  
echo -e "\033[30m 黑色字 \033[0m"  
echo -e "\033[31m 红色字 \033[0m"  
echo -e "\033[32m 绿色字 \033[0m"  
echo -e "\033[33m 黄色字 \033[0m"  
echo -e "\033[34m 蓝色字 \033[0m"  
echo -e "\033[35m 紫色字 \033[0m"  
echo -e "\033[36m 天蓝字 \033[0m"  
echo -e "\033[37m 白色字 \033[0m"  
#字背景颜色范围：40-47  
echo -e "\033[40;37m 黑底白字 \033[0m"  
echo -e "\033[41;30m 红底黑字 \033[0m"  
echo -e "\033[42;34m 绿底蓝字 \033[0m"  
echo -e "\033[43;34m 黄底蓝字 \033[0m"  
echo -e "\033[44;30m 蓝底黑字 \033[0m"  
echo -e "\033[45;30m 紫底黑字 \033[0m"  
echo -e "\033[46;30m 天蓝底黑字 \033[0m"  
echo -e "\033[47;34m 白底蓝字 \033[0m"  

#控制选项说明  
#\033[0m 关闭所有属性  
#\033[1m 设置高亮度  
#\033[4m 下划线  
echo -e "\033[4;31m 下划线红字 \033[0m"  
#闪烁  
echo -e "\033[5;34m 红字在闪烁 \033[0m"  
#反影  
echo -e "\033[8m 消隐 \033[0m "  

#\033[30m-\033[37m 设置前景色  
#\033[40m-\033[47m 设置背景色  
#\033[nA光标上移n行  
#\033[nB光标下移n行  
echo -e "\033[4A 光标上移4行 \033[0m"  
#\033[nC光标右移n行  
#\033[nD光标左移n行  
#\033[y;xH设置光标位置  
#\033[2J清屏  
#\033[K清除从光标到行尾的内容  
echo -e "\033[K 清除光标到行尾的内容 \033[0m"  
#\033[s 保存光标位置  
#\033[u 恢复光标位置  
#\033[?25| 隐藏光标  
#\033[?25h 显示光标  
echo -e "\033[?25l 隐藏光标 \033[0m"  
echo -e "\033[?25h 显示光标 \033[0m"
```

# bash 控制台颜色
打印全部颜色
```bash
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

# tee 将stdin复制一份
- 它只能复制上一个命令的stdout,而忽视stderr,除非`2>&1`
- 下列命令，`tee`将`cat`的stdout输出复制到out.txt,同时`cat`的stdout和stderr的输出都传给了下一个管道
- `-a` 选项是追加，不加的话，每次会覆盖文件的值
```bash
cat a* | tee -a out.txt | cat -n
```

# 自定义文件描述符的使用
```bash
cky@cky-pc:~/workspace/shell$ exec 3<input.txt
-bash: input.txt: 没有那个文件或目录
cky@cky-pc:~/workspace/shell$ echo "test input" > input.txt
cky@cky-pc:~/workspace/shell$ exec 3<input.txt # 定义文件描述符3 (读取)
cky@cky-pc:~/workspace/shell$ cat <&3 # 使用
test input

cky@cky-pc:~/workspace/shell$ exec 4>output.txt  # 创建 截断写入模式 文件描述符
cky@cky-pc:~/workspace/shell$ echo "test file disc 4" >&4 # 使用
cky@cky-pc:~/workspace/shell$ cat output.txt
test file disc 4

cky@cky-pc:~/workspace/shell$ exec 5>> input.txt # 创建 追加写入模式 文件描述符
cky@cky-pc:~/workspace/shell$ echo "file disc 5 test" >&5 # 使用
cky@cky-pc:~/workspace/shell$ cat input.txt
test input
file disc 5 test
```

`-` 作为stdin文本的文件名
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ echo 'text from stdin' | cat hi.txt -
hi code!
text from stdin
```



交互输入自动化
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ ./auto_input.sh
Enter your name:codekissyoung
Enter your age 22
your name is codekissyoung , you are 22 years old
cky@cky-pc:~/workspace/shell$ echo 'codekissyoung\n22\n' | ./auto_input.sh
your name is codekissyoungn22n , you are  years old


# 使用 expect
cky@cky-pc:~/workspace/shell$ sudo apt-get install expect

cky@cky-pc:~/workspace/shell$ cat ./expect.sh
#!/usr/bin/expect
spawn ./auto_input.sh; # 指定要自动化哪一个命令
expect "Enter your name:"; # 如果匹配这个提示，那就输入codekissyoung
send "codekissyoung\n"; # 发送给命令的信息
expect "Enter your age:" # 如果匹配这个提示，那就输入 22
send "22\n"
expect eof # 交互结束


cky@cky-pc:~/workspace/shell$ ./expect.sh
spawn ./auto_input.sh
Enter your name:codekissyoung
Enter your age:22
your name is codekissyoung , you are 22 years old
```



# 使用内建调试命令
- 带 + 号的输出，就是shell实际执行的命令
- `-x` 显示实际执行的命令和参数
- `+x` 禁止调试
- `-v` 当命令进行输入读取时，显示实际读取到的数据
- `+v` 禁止打印输入

```bash
#!/bin/bash
arr=(23 34 56 测试 第五个值 67 76 54 35)
echo ${arr[0]}
index=4
echo ${arr[$index]};
echo ${arr[*]}
echo ${arr[@]}
echo ${#arr[*]}
```

```shell
cky@cky-pc:~/workspace/shell$ bash -x arr.sh 
+ arr=(23 34 56 测试 第五个值 67 76 54 35)
+ echo 23
23
+ index=4
+ echo 第五个值
第五个值
+ echo 23 34 56 测试 第五个值 67 76 54 35
23 34 56 测试 第五个值 67 76 54 35
+ echo 23 34 56 测试 第五个值 67 76 54 35
23 34 56 测试 第五个值 67 76 54 35
+ echo 9
9
```

# 对部分代码进行调试
```bash
#!/bin/bash
arr=(23 34 56 测试 第五个值 67 76 54 35)
echo ${arr[0]}
index=4
echo ${arr[$index]};
set -x # 调试开始
echo ${arr[*]}
echo ${arr[@]}
set +x # 调试结束
echo ${#arr[*]}
```

```bash
cky@cky-pc:~/workspace/shell$ ./arr.sh 
23
第五个值
+ echo 23 34 56 测试 第五个值 67 76 54 35
23 34 56 测试 第五个值 67 76 54 35
+ echo 23 34 56 测试 第五个值 67 76 54 35
23 34 56 测试 第五个值 67 76 54 35
+ set +x
9
```

# shell开头设置
```bash
#!/bin/bash -xv
```



# 判断root用户
```bash
#!/bin/bash
if [ $UID -ne 0 ]; then
	echo "not root user";
else 
	echo "Root User";
fi
```



# 字符串长度
```bash
➜  shell git:(master) var=122131213122sfsfsdfd
➜  shell git:(master) echo ${#var}
20
```

# 字符串比较
- `[[ $a==$b ]]`相等
- `[[ $a!=$b ]]`不等
- `[[ $a>$b ]]`字符序大
- `[[ $a>$b ]]`字符序小
- `[[ -z $a ]]`空字符串
- `[[ -n $a ]]`非空字符串
- `if [[ -z $a ]] && [[ -n $b ]]`将多个条件组合起来 

# 测试字符串是否为文件
-b file	是否是块设备文件，如果是，则返回 true。	[ -b $file ] 返回 false。
-c file	是否是字符设备文件，如果是，则返回 true。	[ -b $file ] 返回 false。
-d file	是否是目录，如果是，则返回 true。	[ -d $file ] 返回 false。
-f file	是否是普通文件（既不是目录，也不是设备文件），如果是，则返回 true。	[ -f $file ] 返回 true。
-g file	是否设置了 SGID 位，如果是，则返回 true。	[ -g $file ] 返回 false。
-k file	是否设置了粘着位(Sticky Bit)，如果是，则返回 true。	[ -k $file ] 返回 false。
-p file	是否是具名管道，如果是，则返回 true。	[ -p $file ] 返回 false。
-u file	是否设置了 SUID 位，如果是，则返回 true。	[ -u $file ] 返回 false。
-r file	是否可读，如果是，则返回 true。	[ -r $file ] 返回 true。
-w file	是否可写，如果是，则返回 true。	[ -w $file ] 返回 true。
-x file	是否可执行，如果是，则返回 true。	[ -x $file ] 返回 true。
-s file	是否为空（文件大小是否大于0），不为空返回 true。	[ -s $file ] 返回 true。
-e file	（包括目录）是否存在，如果是，则返回 true。	[ -e $file ] 返回 true。



