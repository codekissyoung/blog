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
    echo "$i is not equal 1"
fi
```


# 变量
- `$` 是引用变量的意思
- `=` 两边不能有空格
- ` 号里面执行的命令的结果，赋值给变量
- `>` 作为大于号时要转义，否则默认作为重定向处理


```bash
➜  shell git:(master) testing=`date`
➜  shell git:(master) echo $testing
2017年 06月 17日 星期六 16:31:47 CST
```


# 数学运算
- 数学计算对于shell来说是很麻烦的一件事情
- `expr 1 + 5` `expr 5 \* 2` 太麻烦了(*是特殊字符 要转义)
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
var3=`echo "scale=4; $var1 / $var2" | bc` # scale=4; 是设置bc计算器使用4位小数
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
>---echo "date 命令执行成功了"
fi

# grep 没有搜寻到用户 $? = 1
if grep codekissyoung /etc/passwd;then
>---echo "用户codekissyoung存在";
elif grep cky /etc/passwd > /dev/null;then
>---echo "cky 存在";
else
>---echo "用户codekissyoung不存在";
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
>---echo "code 不等于　cky";
fi

# 判断字符存在
var="变量var"
if [ -n $var ]; then
>---echo "$var存在";
fi

# 字符串比较大小
var1="abd"
var2="abc"
if [ $var1 \> $var2 ];then
>---echo "$var1 大于 $var2";
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
>---echo "$HOME 存在";
fi
```

# && 与 || 组合条件
```
if [ -d $HOME ] && [ -w "$HOME" ]; then
>---echo "$HOME 存在并且可读";
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


```
