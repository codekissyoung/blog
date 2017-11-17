# 链接原理
- 可重定位目标文件 `xx.o`
> 编译成的机器指令和数据，因为它往往引用了其他 `xx.o` 中的符号，所以不能单独直接执行，需要将这些引用所在的文件链接进来，这种操作称为重定向
- 可执行目标文件
> 已经将所有引用到的符号的所在文件链接起来，每一个符号都已经得到了解析和重定位，每个符号都是已知的，所以可以被机器直接执行
- 共享目标文件 `*.so`
> 特殊的 `*.o` 文件，程序运行时候才动态加载到内存中运行

# 预编译处理函数
- 函数的定义放 `.c` 文件，函数的声明放 `.h` 文件
- 如果要使用某个 `.c` 文件中定义的函数，只需要 `#include` 这个 `.c` 文件对应的 `.h` 文件
- `.h` 文件的作用：被别人拷贝。编译链接的时候不需要管 `.h` 文件

```c
#define MAX_ARRAY_LENGTH 20M
#undef  FILE_SIZE
#define FILE_SIZE 42

#ifndef MESSAGE
   #define MESSAGE "You wish!"
#endif

#define DEBUG 1
#ifdef DEBUG
#define debug(a, b) printf(#a"\n",b)
#else
#define debug(a,b) ;
#endif

/* 字符串常量化运算符（#） */
#define message_for(a, b)  printf(#a " and " #b " : We love you!\n")
message_for(Carole, Debra); // Carole and Debra: We love you!

/* 标记粘贴运算符（##） */
#define tokenpaster(n) printf ("token" #n " = %d", token##n)
tokenpaster(34); // printf ("token34 = %d", token34);

/* 模拟函数 */
#define square(x) ((x) * (x))
#define MAX(x,y) ((x) > (y) ? (x) : (y))
```

# gdb 调试
- `gcc -g main.c -o cky` 编译启用支持 gdb
- `gdb <program>` program也就是你的执行文件，一般在当然目录下。
- `gdb <program> core` 用gdb同时调试一个运行程序和core文件，core是程序非法执行后core dump后产生的文件。
- `gdb <program> <PID>` 如果你的程序是一个服务程序，那么你可以指定这个服务程序运行时的进程ID。gdb会自动attach上去，并调试他。program应该在PATH环境变量中搜索得到。
- gcc编译不能带上`-O`或者`-O2`优化
- 启动你的程序，可以按照你的自定义的要求随心所欲的运行程序。
- 可让被调试的程序在你所指定的调置的断点处停住。（断点可以是条件表达式）
- 当程序被停住时，可以检查此时你的程序中所发生的事。
- 动态的改变你程序的执行环境。

- 用法
```shell
(1)如何打印变量的值？(print var)
(2)如何打印变量的地址？(print &var)
(3)如何打印地址的数据值？(print *address)
(4)如何查看当前运行的文件和行？(backtrace)
(5)如何查看指定文件的代码？(list file:N)
(6)如何立即执行完当前的函数，但是并不是执行完整个应用程序？(finish)
(7)如果程序是多文件的，怎样定位到指定文件的指定行或者函数？(list file:N)
(8)如果循环次数很多，如何执行完当前的循环？(until)
(9)多线程如何调试？(???)
```

- 列出源文件
```shell
l 1,100 　# 列出1-100行
```
- 运行程序
```shell
r -a -b # 等价于 ./cky -a -b
(gdb)show args #显示程序传入的参数
```
- 打断点
```shell
b　17  #17行打个断点
b func #func函数处打个断点
b 12 if i==9 #在12行处，当i=9时，打个断点
b temp:10  #在temp.c中第10行设置断点
b temp:func  #在temp.c中func函数处打个断点
info break #显示当前断点信息
enable breakpoint 1 #启用1号断点
```

- 清除断点

```shell
(gdb) d 回车 # 清除所有断点
Delete all breakpoints? (y or n) y
(gdb)

(gdb)d breakpoint 1 #删除1号断点
(gdb)clear # 清除当前所在行的断点
(gdb)clear 12　# 清除12行的断点
```


- 查看函数堆栈
```
(gdb)bt
```

- 执行下一行代码
```
(gdb)s + 回车 # Step 执行下一行代码
```

- 直接回车
```
(gdb)       <-------------------- 直接回车表示，重复上一次命令
```

- 观察点
```shell
b 15 ＃在15行打个断点
r # 运行程序
watch i # 观察i值
c # 继续（Continue）执行被调试程序
```

- 在gdb里使用shell命令
```
shell ls -alh
```

- 查看运行时数据
```
p a # 查看当前作用域a的值
p 'f2.c'::x #查看f2.c文件中全局变量x的值
p 'f2.c'::sum::x #查看f2.c中sum函数中x的值
```

core (内核转储文件)
==================================================
- 内核转储的最大好处是能够保存问题发生时的状态。
- 只要有可执行文件和内核转储，就可以知道进程当时的状态。
- 只要获取内核转储，那么即使没有复现环境，也能调试。
- 查看内核转储是否有效

```shell
// -c 表示内核转储文件的大小限制，现在显示为零，表示不能用。
ulimit -c
0
// 可以改为1G
ulimit -c 1073741824
// 也可以改为无限制
ulimit -c unlimited
```

- 永久生效
上面所述的方法，只是在当前shell中生效,重启之后，就不再有效了。永久生效的办法是在`/etc/profile`里面添加`ulimit -c unlimited`,然后再重新加载配置`source /etc/profile`
