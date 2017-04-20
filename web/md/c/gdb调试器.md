# gdb的作用
1. 启动你的程序，可以按照你的自定义的要求随心所欲的运行程序。
1. 可让被调试的程序在你所指定的调置的断点处停住。（断点可以是条件表达式）
1. 当程序被停住时，可以检查此时你的程序中所发生的事。
1. 动态的改变你程序的执行环境。

# gdb的使用注意
1. gcc编译不能带上`-O`或者`-O2`优化

# 编译带上调试参数`-g`
```
gcc -g main.c -o cky
```
# 开始调试
1. `gdb <program>`
    program也就是你的执行文件，一般在当然目录下。

1. `gdb <program> core`
    用gdb同时调试一个运行程序和core文件，core是程序非法执行后core dump后产生的文件。

1. `gdb <program> <PID>`
    如果你的程序是一个服务程序，那么你可以指定这个服务程序运行时的进程ID。gdb会自动attach上去，并调试他。program应该在PATH环境变量中搜索得到。

# 列出源文件
```
l 1,100 　# 列出1-100行
```

# 运行程序
```
r -a -b # 等价于 ./cky -a -b
(gdb)show args #显示程序传入的参数
```

# 打断点
```
b　17  #17行打个断点
b func #func函数处打个断点
b 12 if i==9 #在12行处，当i=9时，打个断点
b temp:10  #在temp.c中第10行设置断点
b temp:func  #在temp.c中func函数处打个断点
info break #显示当前断点信息
enable breakpoint 1 #启用1号断点
```

# 清除断点
```code
(gdb) d 回车 # 清除所有断点
Delete all breakpoints? (y or n) y
(gdb)

(gdb)d breakpoint 1 #删除1号断点
(gdb)clear # 清除当前所在行的断点
(gdb)clear 12　# 清除12行的断点
```


# 查看函数堆栈
```
(gdb)bt
```

# 执行下一行代码
```
(gdb)s + 回车 # Step 执行下一行代码
```

# 直接回车
```
(gdb)       <-------------------- 直接回车表示，重复上一次命令
```

# 观察点
```
b 15 ＃在15行打个断点
r # 运行程序
watch i # 观察i值
c # 继续（Continue）执行被调试程序
```

# 在gdb里使用shell命令
```
shell ls -alh
```

# 查看运行时数据
```
p a # 查看当前作用域a的值
p 'f2.c'::x #查看f2.c文件中全局变量x的值
p 'f2.c'::sum::x #查看f2.c中sum函数中x的值
```
