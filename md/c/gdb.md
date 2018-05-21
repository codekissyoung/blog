# 使用gdb调试c程序

## 启用gdb调试

```bash
$gcc -g main.c -o cky # -g 表示编译支持 gdb 调试, 并且不能带上`-O`或者`-O2`优化
$gdb cky              # 调试 cky 程序
$gdb cky core         # 带上 core 文件一起调试，程序非法执行后 core dump 后产生 core 文件
$gdb cky <PID>        # 指定这个服务程序运行时的进程ID。gdb会自动attach上去，并调试他。program应该在PATH环境变量中搜索得到。
```

## 运行调试程序

```bash
(gdb)r -a -b           # 等价于 cky -a -b
(gdb)start             # 重新执行程序
(gdb)s + 回车           # Step 执行下一行代码
(gdb)回车               # 直接回车表示，重复上一次命令
(gdb)finish            # 让程序运行到当前函数返回为止
(gdb)until             # 让程序运行到当前循环结束为止
(gdb)bt                # 查看当前运行的文件和行
(gdb)c                 # 程序继续运行至 下一个 调试点处
```

## 列出源文件

```bash
(gdb)l 1,100           # 列出1-100行
(gdb)l file:N          # 查看指定文件的第 N 行代码
```

## 断点

```bash
(gdb)i break             # 显示当前断点信息
(gdb)b 17                # 17行 打个断点
(gdb)b func              # func函数处 打个断点
(gdb)b 12 if i==9        # 在12行处，当i=9时，打个断点
(gdb)b temp:10           # 在temp.c中第10行 设置断点
(gdb)b temp:func         # 在temp.c中func函数处 打个断点
(gdb)d enter             # d + 回车 清除所有断点
(gdb)d b 1               # 删除1号断点
```

## 查看程序内变量的值

```bash
(gdb)info locals         # 查看当前作用域内，所有局部变量的值
(gdb)p var               # 打印变量的值
(gdb)p &var              # 打印变量的地址
(gdb)p *address          # 打印地址的数据值
(gdb)p func(5)           # 设定入参，对程序中函数进行调用，看函数返回什么
(gdb)p a                 # 查看当前作用域a的值
(gdb)p 'f2.c'::x         # 查看f2.c文件中全局变量x的值
(gdb)p 'f2.c'::sum::x    # 查看f2.c中sum函数中x的值

(gdb)p arr               # 打印静态数组的值
$3 = {190, 0, 0, 0, 90, 0, 0, 76}

(gdb) p *array@len       # 打印动态数组的值

(gdb) p/a i              # a 按十六进制格式显示变量。 x 按十六进制格式显示变量。u 按十六进制格式显示无符号整型。
$22 = 0x65               # f 按浮点数格式显示变量。 o 按八进制格式显示变量。t 按二进制格式显示变量。c 按字符格式显示变量。

(gdb) bt
#0  add_range (low=1, high=10) at main.c:6
#1  0x00000000004005fc in main (argc=1, argv=0x7fffffffe088) at main.c:15
(gdb) i locals           # 打印当前栈下，所有的局部变量
i = -134225560
sum = 32767
(gdb) f 1                # 切换到 #1 号栈下
#1  0x00000000004005fc in main (argc=1, argv=0x7fffffffe088) at main.c:15
15	    result[0] = add_range(1, 10);
(gdb) i locals           # 打印当前栈(#1) 下 所有局部变量
result = {1, 0, 0, 0, 1, 0}

(gdb) display sum        # 跟踪显示 sum 变量
1: sum = -1747168440
(gdb) display input      # 跟踪显示 input 变量
2: input = "hello"
(gdb) n                  # 每次程序执行后停下来，都会输出监视的变量的值
26	            sum = sum * 10 + input[i] - '0';
1: sum = -1868769330
2: input = "hello"
(gdb) undisplay 2        # 取消对跟踪号为 2 (input)的变量的跟踪显示

(gdb) p input
$28 = "54321"
(gdb) x/7b input         # x 命令打印指定内存的内容，7b是打印格式，b表示每个字节一组，7是表示 7组，
                         # 从input ,char数组第一个字节开始，连续打印7个字节，第六个字节开始就是越界数据了
0x7fffffffdf90: 53	52	51	50	49	48	0
```

## 源代码 / 反汇编代码 / 寄存器变量窗口

- `(gdb) layout src` 显示源代码窗口
- `(gdb) layout asm` 显示反汇编窗口
- `(gdb) layout regs` 显示源代码/反汇编和CPU寄存器窗口
- `(gdb) layout split` 显示源代码和反汇编窗口
- `(gdb) ctrl + L` 刷新窗口

## 修改变量的值

```gdb
(gdb) i locals
i = 11
sum = 0
(gdb) set var sum=10000     # 直接修改程序里当前栈下的变量的值
(gdb) i locals
i = 1
sum = 10000
(gdb) p result[2]=33        # 或者直接让 p 执行表达式来改变程序里变量的值
(gdb) p printf("result[2]=%d",result[2]) # p 命令直接执行表达式
```

## 调试多进程 ( GDB > V7.0 )

| follow-fork-mode |  detach-on-fork |  说明 |
| ---------------- | --------------- |------ |
| parent | on  | 只调试主进程 GDB默认 |
| child  | on  | 只调试子进程 |
| parent | off  | 同时调试两个进程，gdb跟主进程，子进程停在fork位置 |
| child  | off  | 同时调试两个进程，gdb跟子进程，主进程停在fork位置 |

```bash
(gdb)set follow-fork-mode child
(gdb)set detach-on-fork off
(gdb)info inferiors        # 查询正在调试的进程
(gdb)inferior Num          # 切换进程 
```

## gdb 初始化文件 .gdbinit

```shell
set charset UTF-8

# 保存历史命令
set history filename ./.gdb_history
set history save on

# 记录执行gdb的过程
set logging file ./.log.txt
set logging on

# 退出时不显示提示信息
set confirm off

# 打印数组的索引下标
set print array-indexes on

# 每行打印一个结构体成员
set print pretty on

# 自定义命令 qdp : 退出并保留断点
define qbp
save breakpoints ./.gdb_bp
quit
end

# 自定义命令 ldp : 加载历史工作断点
define lbp
source ./.gdb_bp
end
```

- 放在 `/home/用户1/.gdbinit`, 该用户调用 gdb 时自动执行 `.gdbinit` 文件

## core (内核转储文件)

- 内核转储的最大好处是能够保存问题发生时的状态。
- 只要有可执行文件和内核转储，就可以知道进程当时的状态。
- 只要获取内核转储，那么即使没有复现环境，也能调试。
- 查看内核转储是否有效
- 永久生效 : `/etc/profile` 里面添加 `ulimit -c unlimited`

```bash
// -c 表示内核转储文件的大小限制，现在显示为零，表示不能用。
$ ulimit -c
0
// 可以改为1G
$ ulimit -c 1073741824
// 也可以改为无限制
$ ulimit -c unlimited
```

