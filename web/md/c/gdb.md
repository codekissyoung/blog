# 启用gdb调试 -g
```c
gcc -g main.c -o cky
```
- gcc编译不能带上`-O`或者`-O2`优化

# 启动gdb
```bash
gdb <program>
``` 
- program也就是你的执行文件，一般在当然目录下。

```bash
gdb <program> core 
``` 
- **core** : 程序非法执行后core dump后产生的文件

```bash
gdb <program> <PID>
``` 
- 如果你的程序是一个服务程序，那么你可以指定这个服务程序运行时的进程ID。gdb会自动attach上去，并调试他。program应该在PATH环境变量中搜索得到。

# 运行调试程序
```bash
(gdb)r -a -b           # 等价于 cky -a -b
(gdb)s + 回车           # Step 执行下一行代码
(gdb)回车               # 直接回车表示，重复上一次命令
(gdb)finish            # 立即执行完当前的函数，但是并不是执行完整个应用程序
(gdb)until             # 循环次数很多，立即执行完当前的循环
(gdb)bt                # 查看当前运行的文件和行
```

# 列出源文件
```bash
(gdb)l 1,100           # 列出1-100行
(gdb)l file:N          # 查看指定文件的第 N 行代码
```

# 断点
```bash
(gdb)info break          # 显示当前断点信息
(gdb)b 17                # 17行 打个断点
(gdb)b func              # func函数处 打个断点
(gdb)b 12 if i==9        # 在12行处，当i=9时，打个断点
(gdb)b temp:10           # 在temp.c中第10行 设置断点
(gdb)b temp:func         # 在temp.c中func函数处 打个断点
(gdb)d enter             # d + 回车 清除所有断点
(gdb)d b 1               # 删除1号断点
```

# 查看程序内变量的值
```bash
(gdb)info locals         # 查看当前作用域内，所有局部变量的值
(gdb)p var               # 打印变量的值
(gdb)p &var              # 打印变量的地址
(gdb)p *address          # 打印地址的数据值
(gdb)p func(5)           # 设定入参，对程序中函数进行调用，看函数返回什么
(gdb)p a                 # 查看当前作用域a的值
(gdb)p 'f2.c'::x         # 查看f2.c文件中全局变量x的值
(gdb)p 'f2.c'::sum::x    # 查看f2.c中sum函数中x的值

// int *array = (int*)malloc( 8 * sizeof(int) );
(gdb) p *array@8         # 打印数组的值
$3 = {190, 0, 0, 0, 90, 0, 0, 76}
```

# 查看函数堆栈
```
(gdb)bt
```

# core (内核转储文件)
- 内核转储的最大好处是能够保存问题发生时的状态。
- 只要有可执行文件和内核转储，就可以知道进程当时的状态。
- 只要获取内核转储，那么即使没有复现环境，也能调试。
- 查看内核转储是否有效

```bash
// -c 表示内核转储文件的大小限制，现在显示为零，表示不能用。
ulimit -c
0
// 可以改为1G
ulimit -c 1073741824
// 也可以改为无限制
ulimit -c unlimited
```

- 永久生效 : `/etc/profile` 里面添加 `ulimit -c unlimited`
