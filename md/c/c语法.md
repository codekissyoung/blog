# C 语法 概念

## 变量
- 变量用于存储计算过程中的值，变量具有类型(int float char ... )

### 变量类型/单位
- 位(bit)：１或者0称为一位
- 字节(byte)：1 字节 = ８位
- 字(word): 8位计算机，1字长=8位 ,16位计算机:１字长=16位，32位计算机:1字长=32位
- 存储一个int需要占用一个字长
- 浮点数的存储分为3部分:正负号，小数部分,指数部分
- 浮点数舍入错误的原因是，浮点数缺少足够的小数位来完成正确的运算。
```bash
8位int -128 ～ 127
8位uint 0 ～ 255
16位int -32,768 ～ 32,767
16位uint 0 ～ 65,535
32位int -2,147,483,648 ～ 2,147,483,647
32位uint 0 ～ 4,294,967,295 (42亿)
64位int –9,223,372,036,854,775,808 ～ 9,223,372,036,854,775,807
64位uint 0 ～ 18,446,744,073,709,551,615 (千亿万亿级别)
口试一般只会问到16位，问到64位的面试官不是没经验就是找你茬…
```

### typedef 给类型取别名

```c
typedef unsigned char BYTE;
BYTE  b1, b2;

typedef struct Books
{
   char  title[50];
   char  author[50];
   char  subject[100];
   int   book_id;
} Book;
```

### 变量的储存
- 小端法：数据最低位存在内存低地址处
- 大端法：数据最低位存在内存高地址处
- 大端法和小端法的区别在于:处理器体系结构不同

### 局部变量 / 内部变量
- 在函数内部声明与使用的变量，随着函数的调用而创建，随着函数的返回而回收消失
- `静态局部变量` : 在函数内部使用`static`关键字声明，它不会随着函数的返回而消失，下次调用该函数时，`静态局部变量`保持上次函数退出时的值

```c
void trystat(void){
    int fade = 1;
    static int stay = 2; // 静态变量
    printf("fade = %d , stay = %d \n",fade++,stay++);
}
```


### 全局变量 / 外部变量





## 常量
- 在整个程序运算过程中，保持值不变的变量

```c
#define NAME "codekissyoung"
const char *name = "codekissyoung";
```

## 注释
- `//` `/* */` 注释用来说明代码的作用，本身不被编译执行

## 算术运算/运算符/表达式
- `左值` : 指向内存位置的表达式被称为左值（lvalue）表达式。左值可以出现在赋值号的左边或右边
- `右值` ：存储在内存中某些地址的数值。右值是不能对其进行赋值的表达式，也就是说，右值可以出现在赋值号的右边，但不能出现在赋值号的左边

### >> 右移操作符
- 有符号数的右移
- 右移一位就等于除以2，但是这里需要加一个条件，这里指的是正数。而对于有符号整数，且其值为负数时，在C99标准中对于其右移操作的结果的规定是implementation-defined.
- 在Linux上的GCC实现中，有符号数的右移操作的实现为使用符号位作为补充位。因此-1的右移操作仍然为0xFFFFFFFF。这导致了死循环。
```c
#include <stdio.h>
int main( int argc, char* argv[] )
{
    int a = 0xFFFFFFFF;
    printf("%d , %ld",a >> 31,sizeof(a)); // -1 , 4
    return 0;
}
```

### | 或运算

### & 与运算



### ^ 异或运算






## 控制流

## 函数
- 函数是完成特定功能的一段代码的集合，它接受参数，返回计算后的值
- 函数传值调用 ： 函数接受主调方的变量作为参数，拷贝出一份副本，在函数内部只操作该副本，所以不会修改到主调方的变量
- 函数传地址调用 ： 函数接受主调方给出的内存地址(指针/数组名)，复制出一份地址的副本，函数内部操作该地址副本，与主调方操作该内存地址，效果是一样的；所以函数会直接修改到主调方的变量 

### 回调函数

```c
// 定义
void populate_array(int *array, size_t arraySize, int (*getNextValue)(void));
int getNextRandomValue(void);
// 调用
populate_array(myarray, 10, getNextRandomValue);
```

### 可变参数

```c
#include <stdarg.h>
int func(int a, int b, ... )
{
    va_list arg_ptr; // 拿到可变参数 arg_ptr
    void va_start( arg_ptr, b ); // 填入最后一个固定参数 b
    int var1 = va_arg( arg_ptr, int ); // 得到第一个可变参数的值 var1
    double var2 = va_arg( arg_ptr, double ); // 得到第一个可变参数的值 var2
    void va_end( arg_ptr ); // 清理 arg_ptr
}
```

- [用法参考](https://www.cnblogs.com/edver/p/8419807.html)
- [可变参数实现](https://blog.csdn.net/smstong/article/details/50751121)

## 基本输入/输出

## 指针

- `指针` : 指针是一个变量，其值为另一个变量的起始内存地址，指针的类型决定了如何取该内存地址后面的数据(取几个字节，如何切分)

```c
int *ip;    /* 一个整型的指针 */
```

### 函数指针

- `函数指针` : 指向函数。函数指针可以像一般函数一样，用于调用函数、传递参数

```c
typedef int (*fun_ptr)(int,int); // 声明一个指向同样参数、返回值的函数指针类型
```

## 数组

### 字符数组

### 一维数组

```c
double balance[] = {1000.0, 2.0, 3.4, 7.0, 50.0}; // 定义和初始化数组
balance[4] = 50.0; // 使用数组里的项
```

### 多维数组

```c
int a[3][4] = {
    {0, 1, 2, 3} ,   /*  初始化索引号为 0 的行 */
    {4, 5, 6, 7} ,   /*  初始化索引号为 1 的行 */
    {8, 9, 10, 11}   /*  初始化索引号为 2 的行 */
};
// 二维数组存放字符串，读取时当一维数组使用
char names[6][50] = {"马超","关平","赵云","张飞","关羽","刘备"};
for (int i=0; i < 6; i++) {
    printf("悍将名称：%s\n",names[i]);
}
```

## 结构体 / 联合体

- 在 网络协议中 ,通信控制,嵌入式系统,驱动开发 等地方，我们传送的不是简单的字节流(char 型数组),而是多种数据组合起来的一个整体，其表现形式是一个结构体
- 空结构体：一个字节大小，不可能造出 没有任何容量的容器吧
- C语言中的结构体并不能直接进行强制类型转换，只有结构体的指针可以进行强制类型转换

```c
// 定义结构体类型
struct Books
{
   char  title[50];
   char  author[50];
   char  subject[100];
   int   book_id;
};
// 使用结构体类型 声明变量
struct Books b1, b2;

// 也可以用typedef创建新类型
typedef struct
{
    int a;
    char b;
    double c;
} Simple2;
// 现在可以用 Simple2 作为类型, 声明新的结构体变量
Simple2 u1, u2[20], *u3;

//此结构体的声明包含了指向自己类型的指针
struct NODE
{
    char string[100];
    struct NODE *next_node;
};

struct B;    //对结构体B进行不完整声明
//结构体A中包含指向结构体B的指针
struct A
{
    struct B *partner;
    //other members;
};

typedef struct Student {char *name,int age}std, *pstd; //定义结构体struct Student,取别名为std
std st1 = {"codekissyoung",21}; // 定义一个std结构体变量
pstd pst1 = &st1;               // 定义一个std结构体指针,指向st1
st1.name = "hello li";          // 结构体访问单个元素
pst->name;                      // 通过结构体指针访问单个元素
```

### 结构体内存对齐

```c
struct Test
{
    char a;
    double b;
    char c;
};
// 0x7ffd1a3ee510 0x7ffd1a3ee518 0x7ffd1a3ee520 sizeof : 24
struct Test
{
    double b;
    char a;
    char c;
};
// 0x7ffc76f5e660 0x7ffc76f5e668 0x7ffc76f5e669 sizeof : 16
```

### 位域

```c
struct bit_field
{
    int a:4;  //占用4个二进制位;
    int  :0;  //空位域,自动置0;
    int b:4;  //占用4个二进制位,从下一个存储单元开始存放;
    int c:4;  //占用4个二进制位;
    int d:5;  //占用5个二进制位,剩余的4个bit不够存储4个bit的数据,从下一个存储单元开始存放;
    int  :0;  //空位域,自动置0;
    int e:4;  //占用4个二进制位,从这个存储单元开始存放;
};

struct bit_field bt1;
bt1.a = 3;
bt1.b = 4;
bt1.c = 5;
bt1.d = 6;
bt1.e = 2;
```

### 联合体

- 在 union 中 所有的 数据成员 共用一个空间，同一个时间只能储存其中一个数据成员，所有的数据成员具有相同的起始数据地址
- union 使用最大的的长度来储存所有成员，所以只能一个时间，存一个！

```c
union Data
{
    int i;
    float f;
    char  str[20];
};
union Data d1;
strcpy( d1.str, "codekissyoung" );
```

## C预处理器

### 常用指令

- `#define` 定义宏
- `#include` 包含一个源代码文件
- `#undef` 取消已定义的宏
- `#ifdef` 如果宏已经定义，则返回真
- `#ifndef` 如果宏没有定义，则返回真
- `#if` 如果给定条件为真，则编译下面代码
- `#else`
- `#elif` 如果前面的 `#if` 给定条件不为真，当前条件为真，则编译下面代码
- `#endif` 结束一个 `#if` `#else` 条件编译块
- `#error` 当遇到标准错误时，输出错误消息
- `#pragma` 使用标准化方法，向编译器发布特殊的命令到编译器中

### 预定义宏

- ANSI C 定义了许多宏。在编程中您可以使用这些宏，但是不能直接修改这些预定义的宏。

```c
#include <stdio.h>
main()
{
   printf("File :%s\n", __FILE__ ); // 当前日期，一个以 "MMM DD YYYY" 格式表示的字符常量。
   printf("Date :%s\n", __DATE__ ); // 当前时间，一个以 "HH:MM:SS" 格式表示的字符常量。
   printf("Time :%s\n", __TIME__ ); // 这会包含当前文件名，一个字符串常量。
   printf("Line :%d\n", __LINE__ ); // 这会包含当前行号，一个十进制常量。
   printf("ANSI :%d\n", __STDC__ ); // 当编译器以 ANSI 标准编译时，则定义为 1。
}
// File :test.c
// Date :Jun 2 2012
// Time :03:36:24
// Line :8
// ANSI :1
```

## 标准库

### stdio标准输入/输出流

- 各个操作系统底层对文件的操作都是不一样的，如windows 的 ntfs 和linux 的 ext3 ！
- stdio.h 屏蔽了这种不同，使用了流来管理文件
- stdin 输入流,默认指向键盘
- stdout 输出流,默认指向屏幕
- stderr 错误输出流，默认输入也是屏幕
- 输入输出重定向：`<` 是输入 `>` 是输出 `>>`是追加输出 `2>`是错误输出重定向 `2>>`错误输出重定向追加输出
- c程序从流中获取数据，或者将数据输出到流中
- c程序将输入视为一个外来字节的流，getchar() 函数将每个字节解释为一个字符编码。scanf()函数将以同样的方式看待输入，但在其转换 说明符的指导下，该函数可以将字符转换为数值。如果scanf 读取失败，它会将数据还给字节流。
- 如果输入的是文件，检测到文件末尾时，scanf 和 getchar 都返回 EOF 值。
- 如果是键盘输入，能用 `Ctrl + D` 或者 `Ctrl + z` 来模拟从键盘模拟文件结束条件。

```c
#define    EOF    （-1）    // 这个判断流到达末尾的标志符
#include <stdio.h>
int main(){
  char ch;
  while((ch=getchar()) != EOF )  //getchar 是从输入流中读取一个字符
  putchar(ch);    //输出一个字符
  return 0;
}
```

```c
/*先用 scanf 读取数字，失败的话，再用 getchar 读取处理*/
int get_int(void)
{
    int input;
    char ch;
    while(scanf("%d",&input)!=1){
        while((ch = getchar())!= '\n'){
            putchar (ch); //剔除错误的输入
        }
        printf("is not an integer .\n please enter an integer value !");
    }
    return input ;
}
```

### 输入函数/输出函数
- 输入也是先放在缓冲区,代码读取缓冲区内容的条件: 1.遇见换行符 2.缓冲区满了
- 所有输出的内容都是先存放到缓冲区，再由缓冲区一次性输出到屏幕。缓冲区内容刷新发送到屏幕的条件：1.缓冲区满 2.换行符 3.遇见输入命令/代码
```c
scanf("%s",&name); 读取缓存中的字符串，会在空白 ，\t,\n 处停止读取！
scanf("%d,%d",&grade,&age); //表示 期望我们以： 3,12 这样的形式输入
prinf("%d %s %p",10,"caokaiyan",point);//point 是一个指针
```

### 二进制文件与文本文件区别
- 文本文件与二进制文件的区别是逻辑上的。
  - 文本文件是基于字符编码的文件，常见有ASCII编码(定长编码)，UNICODE编码,UTF-8(非定长的编码)
  - 二进制文件是基于值编码的文件，你可以根据具体应用，指定某个值是什么意思（可以看作是自定义编码），是变长编码的，因为是值编码嘛，多少个比特代表一个值，完全由你决定
- BMP文件例子：其头部是较为固定长度的文件头信息，前2字节用来记录文件为BMP格式，接下来的8个字节用来记录文件长度，再接下来的4字节用来记录bmp文件头的长度。
