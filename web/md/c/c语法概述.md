# C 特点
- 可以操作指针,这是非常自由的，但是拥有自由的代价是你必须时刻保持警惕
- 大量的运算符和其组合，需要程序员记住大量的运算符规则，优先级
- 指令即为数字码,程序的实质就是一系列指令集合,c语言解放了直接用数字码写程序的时代，c使用编译器来将c代码程序编译成指令集合
- `声明`的概念,`定义`的概念,`数据类型`的概念
- `函数原型prototype｜函数声明function declaration`的概念,`函数定义 function definition`的概念,`函数调用 function call`的概念


# 引入库 和 头文件
```c
#include <stdio.h>
#include "include/common.h"
```

# 声明变量
```c
int a , b; // 整数
int date[10]; // 数组
int *p = &a; // 指针

```

# 常量
```
#define    BUG_NUM   100
```

# 声明函数 定义函数
```c
// func.h
extern int func(int a ,int b);

// func.c
int func(int a ,int b){
    return n;
}
```

# 精简while
```c
while(scanf("%ld",&num) == 1)  // 获取值和判断都成功
{
    // code
}
```
# 表达式合并
注意`()`不能省，`!=`优先级高
```c
while(( ch = getchar()) != '\n'){
}
```

# 选择循环
- 对于需要计数的或者初始化条件的，比如`++num;` 选用`for`循环
- 对于先行判断是否要执行的,选择`while(){}`
- 对于依据代码执行，判断是否要退出的,使用`do{}while();`

# 三目运算符
```
max = (a > b) ? a : b; // 若判断为真,则整个语句结果为a表达式计算的值,反之为b
```

# 判断空字符串
```c
while( * string )
{

}
```

# c代码组织形式
- 函数分类,按模块划分功能
- 如果一个模块内的函数需要被其他模块引用,应该申明为extern
- 如果一个模块内的函数只被当前模块引用，应该申明为static,这样可以避免各个模块的重名错误
- common.h 文件编写,各个模块都需要引用该头文件

## common.h 文件内容
- 所有模块共同需要的头文件,eg. stdio.h stdlib.h
- 所有模块公用的宏定义，eg.调试开关 缓冲区的大小
- 所有全局变量的申明
- 所有模块的函数接口
- 不包括全局变量的定义!不包括全局变量的定义!不包括全局变量的定义!




# 将数组传入函数
- 传入的实际是数组的首地址，然后通过整个地址来访问数组

```c
int str[] = {2,3,4,5,6};
// 定义一
int array_func(int arr[],int size){

}
// 定义二
int array_func2(int *arr,int size){

}
array_func(str,sizeof(str));
array_func2(str,sizeof(str));
```

# 从函数中返回数组
- 在函数内部定义的局部变量不能返回它的地址给函数外部使用，除非它是static 或者是向堆申请的内存
- 想从函数返回一个一维数组，要声明返回指针
```c
int * myFunc(){
	static int arr[10];
	// ...
	return arr;
}
```

# 指向数组的指针
- 将数组名赋值给指针后，可以使用指针来依次访问数组元素
```c
double *p;
double balance[10];
p = balance;
*p; // balance[0];
*(p + 1); // balance[1];
```

# 指针
- 对于任意一个变量，都可以使用`&`来取它的内存地址
- 指针就是用来存放内存地址的一种变量，它有类型的区分，不同类型之间的指针不能相互赋值
```
int a = 19;
printf(" a address : %p \n",&a);

double *dou; // 声明一个double类型指针
```
