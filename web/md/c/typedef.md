# 给普通类型取别名
```c
typedef int INTEGER;
INTEGER a, b;
a = 1;
b = 2;
```

# 给数组取别名
```c
typedef char ARRAY20[20];
ARRAY20 a1, a2, s1, s2;  // 等价于 char a1[20], a2[20], s1[20], s2[20];
```

# 给结构体取别名
```c
typedef struct stu{
    char name[20];
    int age;
    char sex;
} STU;
STU body1,body2; //  struct stu body1, body2
```

# 给指针取别名
```c
typedef int (* PTR_TO_ARR)[4];
PTR_TO_ARR p1, p2; // 两个指向二维数组的指针
```

# 给函数指针取别名
```c
typedef int (* PTR_TO_FUNC)(int, int);
PTR_TO_FUNC pfunc; // 指向 int (int ,int)类型 函数的指针
```

# 与`#define` 的区别
- define可以使用其他类型说明符对宏类型名进行扩展，但对 typedef 所定义的类型名却不能这样做。
    ```c
    #define INTERGE int
    unsigned INTERGE n;  //没问题

    typedef int INTERGE;
    unsigned INTERGE n;  //错误，不能在 INTERGE 前面添加 unsigned
    ```

- 在连续定义几个变量的时候，typedef 能够保证定义的所有变量均为同一类型，而 `#define` 则无法保证
    ```c
    #define PTR_INT int *
    PTR_INT p1, p2; // 宏替换之后: int *p1, p2;

    typedef int * PTR_INT
    PTR_INT p1, p2; // 都是指向int的指针
    ```
