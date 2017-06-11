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
