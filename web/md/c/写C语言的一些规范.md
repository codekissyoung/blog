# 匈牙利式命名
```c
char chName;
byte bName;
long lName;

// 指针
char*   pchName;
byte*   pbName;
long*   plName;
void*   pvName;
char**  ppchName;
byte**  ppbName;
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
