# 结构体
将一些离散的数据打包放一起
```c++
typedef struct Student {char *name,int age}std,* pstd;//定义结构体struct Student,取别名为std
std st1 = {"codekissyoung",21}; //定义一个std结构体变量
pstd pst1 = &st1;    //定义一个std结构体指针,指向st1
st1.name = "hello li"; 结构体访问单个元素
pst->name; 通过结构体指针访问单个元素
```


# struct 提供 数据类型打包功能
- 在 网络协议中 ,通信控制,嵌入式系统,驱动开发 等地方，我们传送的不是简单的字节流(char 型数组),而是多种数据组合起来的一个整体，其表现形式是一个结构体。
空结构体：一个字节大小，不可能造出 没有任何容量的容器吧


# Union 压缩空间用的
```c++
union  StateMachine{
    char  character;
    int number;
    char* str;
    double  exp;
}
```
- 在 union 中 所有的 数据成员 共用一个空间，同一个时间只能储存其中一个数据成员，所有的数据成员具有相同的起始数据地址
- union 使用最大的的长度(double) 来储存所有成员，所以只能一个时间，存一个！