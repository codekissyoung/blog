# c 预处理器1972加入
- 提供字符串替换
- 提供头文件`(*.h)`包含
- 通用代码模板的扩展
- 宏最好只用于命名常量，并为一些适当的结构提供简洁的记法
- 千万别用c预处理器修改语言的基础结构
- 空格带来的影响

```c
#define a(y) a_expanded(y)
a(x);// 被拓展为 a_expanded(x)
```
区别于
```c
#define a (y) a_expanded(y)
a(x); // 被拓展为　(y) a_expanded(y)(x)
```

# 链接原理
#### 可重定位目标文件 `*.o`
- 编译成的机器指令和数据，因为它往往引用了其他 `xx.o` 中的符号，所以不能单独直接执行，需要将这些引用所在的文件链接进来，这种操作称为重定向

#### 共享目标文件 `*.so`
- 特殊的 `*.o` 文件，程序运行时候才动态加载到内存中运行

#### 可执行目标文件
- 已经将所有引用到的符号的所在文件链接起来，每一个符号都已经得到了解析和重定位，每个符号都是已知的，所以可以被机器直接执行

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

# gcc 编译
```bash
gcc -o hello hello.c   -I/home/hello/include   -L/home/hello/lib    -lworld
```
- `-I /home/hello/include` : 表示将/home/hello/include目录作为第一个寻找头文件的目录，寻找的顺序 `/home/hello/include /usr/include /usr/local/include`

- `-L /home/hello/lib` : 表示将/home/hello/lib目录作为第一个寻找库文件的目录, 寻找的顺序是 `/home/hello/lib /lib /usr/lib /usr/local/lib`

- `-l word` 表示寻找动态链接库文件`libword.so` 也就是文件名去掉前缀和后缀所代表的库文件

- 如果加上编译选项-static，表示寻找静态链接库文件，也就是 `libword.a`

- 对于第三方提供的动态链接库(.so），一般将其拷贝到一个lib目录下(/usr/local/lib），或者使用-L来指定其所在目录， 然后使用-l来指定其名称
