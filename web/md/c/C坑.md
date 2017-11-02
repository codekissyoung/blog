# 原型不要放 `.c` 文件里
- 因为有时候会修改了函数定义，但忘记了修改原型，这时候在调用该函数处，到底是使用函数原型呢？还是使用函数定义呢？这是不明确的，可能编译不会报错，但运行却会出现莫名奇妙的bug

# 不能在定义`typedef`类型之前 使用这个类型
```c++
typedef struct
{
    char* item;
    NODEPTR next; // 这里不允许使用 NODEPTR
} * NODEPTR;

// 以下是正确的方法
// 1.
typedef struct node
{
    char* item;
    struct node* next;
} * NODEPTR;

// 2.
struct node;
typedef struct node* NODEPTR;
struct node
{
    char* item;
    NODEPTR next;
}

// 3.
struct node
{
    char* item;
    struct node* next;
};
typedef struct node *NODEPTR;
```
