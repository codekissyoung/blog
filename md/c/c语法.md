# C 所有语法

- `左值` : 指向内存位置的表达式被称为左值（lvalue）表达式。左值可以出现在赋值号的左边或右边
- `右值` ：存储在内存中某些地址的数值。右值是不能对其进行赋值的表达式，也就是说，右值可以出现在赋值号的右边，但不能出现在赋值号的左边

## 定义常量

```c
#define NAME "codekissyoung"
const char *name = "codekissyoung";
```

## 一维数组

```c
double balance[] = {1000.0, 2.0, 3.4, 7.0, 50.0}; // 定义和初始化数组
balance[4] = 50.0; // 使用数组里的项
```

## 多维数组

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

## 定义函数内静态变量

- `静态局部变量`: 在程序的生命周期内保持局部变量的存在，而不需要在每次它进入和离开作用域时进行创建和销毁

```c
void trystat(void){
    int fade = 1;
    static int stay = 2; // 静态变量
    printf("fade = %d , stay = %d \n",fade++,stay++);
}
```

## 模块化: 创建只在linux本文件内可以访问的变量和函数

```c
static char *USERNAME = "codekissyoung"; // 只在本文件可以访问
static void check_name(){ } // 只在本文件可以访问
extern void show_name() // 暴露给外部文件调用的函数
{
    check_name();
    printf("%s",USERNAME);
}
```

## 指针

- `指针` : 指针是一个变量，其值为另一个变量的起始内存地址，指针的类型决定了如何取该内存地址后面的数据(取几个字节，如何切分)

```c
int *ip;    /* 一个整型的指针 */
```

## 函数指针

- `函数指针` : 指向函数。函数指针可以像一般函数一样，用于调用函数、传递参数

```c
typedef int (*fun_ptr)(int,int); // 声明一个指向同样参数、返回值的函数指针类型
```

## 回调函数

```c
// 定义
void populate_array(int *array, size_t arraySize, int (*getNextValue)(void));
int getNextRandomValue(void);
// 调用
populate_array(myarray, 10, getNextRandomValue);
```

## 结构体

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

## 位域

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

## 联合体

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

## typedef 给定义取别名

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

## 可变参数

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