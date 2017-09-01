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

