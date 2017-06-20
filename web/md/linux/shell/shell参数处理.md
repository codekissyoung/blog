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




















