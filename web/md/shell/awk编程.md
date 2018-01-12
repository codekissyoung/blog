# 能力
- 处理格式化文本 和 数据 : 改变数据的格式 验证合法性 寻求某些属性的项 数字求和 输出数据报表

# 特点
- 内置字段: sed 只有行 而没有内置的字段模型
- 自动读取文件 和 分割字段

# 缺点
- 各种复杂的数据结构难以实现
- 对 Unicode 支持不好

# 命令
- shell 命令 : `awk [-v var=value] -Fre 'pattern { action }' var=value datafiles`
- awk 脚本 : `awk [-v var=value] -Fre -f awk脚本 var=value datafiles`

```bash
-v 设置初始变量，存在于 BEGIN 之前
-F 设置字段分割符 ，re 是正则表达式
pattern : 行匹配模式，省略的话就是匹配所有行
{ action } : 输出模式，省略的话就是输出整行
```

- awk 脚本

```awk
BEGING{
    // 一般就是设置下分割符 定义变量 以及输出信息行等代码
    // 然后进入主循环
}
pattern1 { action1 }
pattern2 { action2 }
END{

}
```

- awk脚本内置环境变量

```bash
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
$0                 变量是指整条记录
$1                 表示当前行的第一个域
$2                 表示当前行的第二个域...以此类推
```

- 工作流程

```bash
1. 先执行BEGING
2. 然后读取文件，读入有 /n 换行符分割的一条记录
3. 然后将记录按指定的域分隔符划分域，填充域，$0则表示所有域,$1表示第一个域,$n表示第n个域,
4. 随后开始执行模式所对应的动作action
5. 接着开始读入第二条记录···直到所有的记录都读完
6. 最后执行END操作
```

# 参考
http://www.cnblogs.com/softwaretesting/archive/2012/02/02/2335332.html
http://blog.csdn.net/wzhwho/article/details/5513791
http://blog.sina.com.cn/s/blog_7b9ace5301014q8o.html

- 支持while、do/while、for、break、continue，这些关键字的语义和C语言中的语义完全相同
- 数组：awk中数组的下标可以是数字和字母，数组的下标通常被称为关键字(key)值和关键字都存储在内部的一张针对key/value应用hash的表格里,由于hash不是顺序存储，因此在显示数组内容时会发现，它们并不是按照你预料的顺序显示出来的
- 数组和变量一样，都是在使用时自动创建的，awk也同样会自动判断其存储的是数字还是字符串
- 一般而言，awk中的数组用来从记录中收集信息，可以用于计算总和、统计单词以及跟踪模板被匹配的次数等等

# 关系运算符

```bash
== 相等
!= 不等
<  小于
<= 小于等于
>  大于
>= 大于等于
1为真，0 为假
字符串较短的会定义为小于较长的那个,"A"< "AA" 的值为真
```

- 例子

```awk
// 字符串转数字：变量通过"+"连接运算，自动强制将字符串转为整型，非数字变成0
awk 'BEGIN{a=1;b=2;c=a+b;print c}'  // 3

// 如果只是显示/etc/passwd的账户
cat /etc/passwd |awk  -F:  '{print $1}'

// 对匹配到了 root 的行执行 action
➜  ~ awk -F: '/root/' /etc/passwd
root:x:0:0:root:/root:/bin/bash

// 对匹配到了 root 的行执行 action
➜  ~ awk -F: '/root/{print $7}' /etc/passwd
/bin/bash

// 显示/etc/passwd的账户
awk -F ':' 'BEGIN {count=0;} {name[count] = $1;count++;}; END{for (i = 0; i < NR; i++) print i, name[i]}' /etc/passwd

// 删除用户zdd的所有文件，注意-rf后面有一个空格
ls -l | awk '/zdd/{print "rm -rf " $9} | sh
```

- BEGIN可以用来打印表头或者列名等，如下
```bash
BEGIN{
    -F":"
    printf "----------------------------------------------------------------\n"
    printf "%-20s%-16s  Jan  |  Feb  |  Mar  |Total Donated\n ","NAME","PHONE"
    printf "----------------------------------------------------------------\n"
}
```

- awk 脚本例子
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
