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

```bash



```

getopt
================================================================================


```bash
```




read
================================================================================
```
read -p "提示语句" variable1 variable2 variableN 
```

- -t 参数来限制用户的输入时间
- -s 参数可以不显示用户的输入

```bash
#!/bin/bash
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

$() 等价于反引号 ：命令替换
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ echo the last sunday is $(date -d "last sunday" +%Y-%m-%d)
the last sunday is 2017-06-25
```

${} 用作变量替换
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ A=B
cky@cky-pc:~/workspace/shell$ echo $AB

cky@cky-pc:~/workspace/shell$ echo ${A}B
BB

```


xargs 重新格式化参数
================================================================================
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


```










