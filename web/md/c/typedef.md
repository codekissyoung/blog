# 含义
- 很多人认为 typedef 是定义新的数据类型，这可能与这个关键字有关。本来嘛，type 是数据类型的意思；def(ine)是定义的意思，合起来就是定义数据类型啦。不过很遗憾，这种理解是不正确的。也许这个关键字该被替换为"typerename"或是别的词。
- typedef 的真正意思是给一个已经存在的数据类型（注意：是类型不是变量）取一个别名，而非定义一个新的数据类型

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

# 给指针取别名
```c
typedef int (* PTR_TO_ARR)[4];
PTR_TO_ARR p1, p2; // 两个指向二维数组的指针
```

# 给结构体取别名
```c
typedef struct student{
    //code
} Stu_st , * Stu_pst;
```
- `struct student stu1` 等价于`Stu_st stu1`
- `struct student* stu2` 等价于 `Stu_pst stu2` 等价于 `Stu_st* stu2`
- 把`struct student { ... }` 看成一个整体，typedef 就是给它取了个别名叫`Stu_st`
- 同时把`struct student { ... } *` 取了个别名叫`Stu_pst` , **只不过这两个名字同时取而已**

# 给函数指针取别名
```c
typedef int (* PTR_TO_FUNC)(int, int);
PTR_TO_FUNC pfunc; // 指向 int (int ,int)类型 函数的指针
```

# typedef 与`#define` 的区别
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

# 主要用途
- 帮助struct声明新对象，这样可以少写一个struct,至于为什么c里使用结构体声明变量要struct开头(c++里不用)，可能就历史遗留问题了

```c
//  原先
struct Book { ... }; // 定义结构体
struct Book bk1; // 使用结构体声明变量

// typedef 后
typedef struct Book{ ... } Book; // 定义结构Book，并且取别名也为 Book
Book bk2; // 直接使用别名声明变量
```
- 跨平台

```c
// 比如定义一个叫 REAL 的浮点类型，在目标平台一上，让它表示最高精度的类型为：
typedef long double REAL;

// 在不支持 long double 的平台二上，改为：
typedef double REAL;

// 在连 double 都不支持的平台三上，改为：
typedef float REAL;

// 也就是说，当跨平台时，只要改下 typedef 本身就行，不用对其他源码做任何修改。
```

- 为复杂的声明定义一个新的简单的别名
- 复杂声明查看原则 : 从变量名看起，先往右，再往左，碰到一个圆括号就调转阅读的方向；括号内分析完就跳出括号，还是按先右后左的顺序，如此循环，直到整个声明分析完

```c
// 原声明 ,变量名为b,先往右看,明显为一个数组
void (* b[10])(void ( * )());

// 先简化(void( * )())
typedef void (* pFunParam)();
// 然后再简化原声明
typedef void (* pFunx)(pFunParam);
// 下列声明等价原声明
pFunx b[10];

// 原声明，变量名为e,
double (*)()(* e)[9];
// 别名一
typedef double(* pFuny)();
// 别名二
typedef pFuny (* pFunParamy)[9];
// 等价原声明
pFunParamy e;

// 原声明
// 首先找到变量名func，外面有一对圆括号，而且左边是一个*号，这说明func是一个指针
// 然后跳出这个圆括号，先看右边，又遇到圆括号，这说明(*func)是一个函数,所以func是一个指向这类函数的指针，即函数指针
// 这类函数具有int*类型的形参，返回值类型是int
int (* func)(int * p);

// 原声明
// func右边是一个[]运算符，说明func是具有5个元素的数组；
// func的左边有一个 *，说明func的元素是指针（注意这里的 * 不是修饰func，而是修饰func[5]的，原因是[]运算符优先级比 * 高，func先跟[]结合）
// 跳出这个括号，看右边，又遇到圆括号，说明func数组的元素是函数类型的指针，它指向的函数具有 int * 类型的形参，返回值类型为int
int ( * func[5])( int * )
```

- 参考例子
```c
#include<stdio.h>    

typedef int (* FP_CALC)(int, int);    

int add(int a, int b)    
{    
     return a + b;    
}    
int sub(int a, int b)    
{    
     return a - b;    
}    
int mul(int a, int b)    
{    
     return a * b;    
}    
int div(int a, int b)    
{    
     return b? a/b : -1;    
}    

FP_CALC calc_func(char op)    
{    
     switch (op)    
     {    
     case '+': return add;//返回函数的地址    
     case '-': return sub;    
     case '\*': return mul;    
     case '/': return div;    
     default:    
         return NULL;    
     }    
     return NULL;    
}    

int (* s_calc_func(char op)) (int, int)    
{    
     return calc_func(op);    
}     

int calc(int a, int b, char op)    
{    
    FP_CALC fp = calc_func(op); //根据预算符得到各种运算的函数的地址  
    //同样你也可以使用下面这种方法    
    //int (* s_fp)(int, int) = s_calc_func(op);//用于测试    
    //ASSERT(fp == s_fp);   // 可以断言这俩是相等的    
    if (fp)   
        return fp(a, b);    
    else   
        return -1;    
}    

void main()    
{       
    int a = 100, b = 20;    
    printf("calc(%d, %d, %c) = %d\n", a, b, '+', calc(a, b, '+'));    
    printf("calc(%d, %d, %c) = %d\n", a, b, '-', calc(a, b, '-'));    
    printf("calc(%d, %d, %c) = %d\n", a, b, '*', calc(a, b, '*'));    
    printf("calc(%d, %d, %c) = %d\n", a, b, '/', calc(a, b, '/'));    
}    
```
