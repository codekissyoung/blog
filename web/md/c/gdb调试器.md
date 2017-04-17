# 编译带上调试参数-g
```
gcc -g main.c -o cky
```
# 开始调试
```
gdb cky
```

# 列出源文件
```
l 1,100 　# 列出1-100行
```

# 运行程序
```
r -a -b # 等价于 ./cky -a -b
```

# 打断点
```
b　17  #17行打个断点
b func #func函数处打个断点
b 12 if i==9 #在12行处，当i=9时，打个断点
b temp:10  #在temp.c中第10行设置断点
b temp:func  #在temp.c中func函数处打个断点
info break #显示当前断点信息
d breakpoint 1 #删除1号断点
disable breakpoint 1 #禁用1号断点
enable breakpoint 1 #启用1号断点
clear # 清除当前所在行的断点
clear 12　# 清除12行的断点
```

# 观察点
```
b 15 ＃在15行打个断点
r # 运行程序
watch i # 观察i值
continue # 一步一步执行程序,观察i的变化
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
