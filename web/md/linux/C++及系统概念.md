# 指令集体系结构
计算机最底层的东西是 cpu 的 Instruction set architecture （指令集体系结构）。也就是指令集，它对应着 汇编语言 ！汇编语言本质就是 指令的助记形式。
指令就是在操作内存，内存在它眼里就是一块大的连续的字节数组，它没有数据类型的概念，没有if  for 等概念，它有的只是 jump ：跳到哪一个内存位置去执行那里的指令序列。
一条机器指令 只执行一个非常基本的操作。
将存放在寄存器中的两个数字相加, 在存储器和寄存器之间 传递数据 ,条件分支转移到新的指令地址。
编译器必须产生这些指令的序列，从而实现(像算术表达式求值，循环，或者过程调用和返回这样的) 程序结构。
在不同的上下文中，一个同样的 字节序列 可能表示 一个整数，浮点数，字符串 或者机械指令 !
# 程序计数器
记录的是将要执行的指令的内存地址。执行完一条指令，它自增1。可以修改它，让cpu执行别处内存的指令。
# 寄存器
cpu 内部用于暂时记录数据或者指令的的器件。
# 程序上下文
在进程中：操作系统保持跟踪进程所需的所有状态信息。这种状态，也就是上下文，它包括许多信息（例如pc和寄存器文件的当前值，以及主存的内容）。进程的切换也可以理解为上下文切换！
# 线程
运行在进程的上下文中，共享同样的代码和全局数据！
# 虚拟存储器
它是个抽象概念,为每个进程提供了一个假象：即每个进程都在独占使用主存，看到的都是一致的存储器，称为虚拟地址空间！虚拟地址空间由：代码区，全局变量区，堆，共享库，栈和内核区构成！
# 文件
文件就是字节序列，仅此而已。每个I/O设备，包括磁盘，键盘，显示器，甚至网络，都可以被视为文件。系统中所有的输入输出都是通过使用一小组称为 Unix I/O 的系统函数调用读写文件 来实现的！
文件向应用程序提供了一个统一的视图，来看待系统中可能含有的所有各式各样的 I/O 设备！

# 并发：concurrency
指的是同时运行多个活动的系统！
进程级的并发：通过分时技术，让cpu在多个进程间快速的切换 模拟实现的！
线程级的并发：使用线程我们可以在一个进程中执行多个控制流。
超线程技术：（simultaneous multi-threading）是一项允许一个cpu执行多个控制流的技术。它让cpu 的（程序计数器和寄存器文件）有多个备份，而运算单元只需一份。常规的处理器需要大约20000个时钟周期做不同 进程 之间的切换，而超线程的处理器可以在单个周期的基础上决定要执行哪一个线程。例如，一个线程必须要等到某些数据被装载到高速缓存中，那cpu 就可以继续去执行另一个线程。intel 的 core i7 处理器可以让一个核执行两个线程，所以一个4核的系统实际上可以并行的执行8个线程。
# 并行：parallelism
使用并发使得一个系统运行的更快！
# 无符号编码：基于二进制
补码编码：有符号数，将最高位解释为 正负，通过补码运算，得出负数的大小
浮点数编码：已 2 为基数的 科学计数法，表示实数。
数 是有范围的，当计算超出 范围，就会发生溢出！整数发生溢出 可能会变负数，单是浮点数溢出会变成+无穷大，而且浮点数的正数运算都是正的！
整数运算和浮点数运算 会有不同的数学属性是因为，它们处理数字表示有限性的方式不同！
整数运算时精确的，但是范围小，而浮点数是近似的！
数据类型（int char 之类） 占用的范围，对于一个程序的 正确性 和 可移植性是非常重要的。

# 基本术语
Data   ：计算机处理的原料
Data  element : 类似于数据结构的字段，不可再分的原子
Data  object : 性质相同的元素的集合
Data  struct  :　数据　＋　它们之间的特定的关系　Data_Structure    =   (D,S);
automic   data  type  : 原子类型
fixed-aggregate   data  type : 聚合类型，里面包含了固定的几个原子类型
variable-aggregate  data  type :可变聚合类型　，里面包含了不确定个数的原子数据

# 逻辑结构 和 储存结构
算法的设计取决于 选定的逻辑结构，而其实现依赖采用的存储结构。
存储结构：顺序存储结构    ：如 数组，存储在连续的内存空间，元素为固定字节长度
               　链式存储结构    ：如 单向链表， 数据存储不连续，依赖 指针指向 下一个元素 的内存地址
# 数据类型
在数据结构的观点下，数据类型是一个 值的集合 和定义在这个值集上的一组操作的总称。如，c 中的int，其值为[min,max],定义在其上的操作为 +，-，*，/，%

# ADT
Abstract    Data    Type， 它的定义仅仅取决于它的一组逻辑特性，而与其在计算机内部的表示和实现无关。
即 其内部结构 不论如何变化，只要它的数学特性不变，都不影响其外部的使用。
ADT    =    (D,S,P);
D是数据对象，S是D上的关系集，P是对D的基本操作集。
ADT    抽象数据类型名{
    数据对象:<数据对象的定义>
    数据关系:<数据关系的定义>
    基本操作:<基本操作的定义>
}
基本操作名(参数表)
    初始条件：<初始条件描述>
    操作结果:  <操作结果描述>


### 变量 定义 和变量声明的区别 ？
定义创建了这个变量，并且为这个变量分配了内存。声明没有分配内存，只是告诉 编译器：这个名字已经匹配到一块内存上了，并且这个名字我用了，其他地方不能再用了

### bool 变量和 0 进行比较
编译器不同，FALSE 被认为 0，TRUE被认为是 -1，1 等
bool    bTestFlag = FAlSE ;
直接使用  if(bTestFlag) 或者 if(!bTestFlag)判断，而不是和 0 ，1 等进行比较
###float 变量和 0 进行比较：精度问题 0.0不等于0.00
```
float    fTestVal=0.0;
\#define    EPSINON    0.000001
```
使用 ：if(fTestVal>=-EPSINON && fTestVal <= EPSINON) 进行判断
###指针变量和 0 进行比较
int    *p=NULL; if(NULL==p);if(NULL != p);
###分号的问题
if ( NULL != p);
    fun();
fun(); if 语句没用，因为 ; 是空语句
###if 的问题
将 执行概率大的代码 放入 if 里面 ，执行概览小的 放入 else 里面
###多层循环问题
外循环 5 次，内循环100 次： 效率高
外循环100 次，内循环 5 次:    效率低
### 循环变量问题
for( n=0;n<10;n++){     if(..){n=8;}}
在执行代码里面修改循环变量的值，很容易导致循环失控
###void ：抽象数据类型
作用：1,对函数返回的限定    2, 对函数参数的限定
float    *p1;    int    *p2;    p1=p2;   //编译错误 cannot    convert    from    int*    to    float*
void    *p1;    int    *p2;    p1=p2;    //编译正确, void 类型指针可以接受任意 数据类型 指针的赋值
void    *p1;    int    *p2;    p2=p1;    //编译错误，can not convert    from    void*    to    int*
int    function(void);    //说明 函数 是不需要参数的
void    function(int a,int b);    //说明无返回值
void指针 分为 ANSI 标准    和 GNU    标准，GNU 标准更加开放，支持更多的语法
void    *povid;
povid++;   povid+=1;  //ANSI 错误   ,理由：进行算法操作的指针必须是确定知道其 指向数据类型 大小的。也就是说，不但要知道器内存地址，还要知道 可以访问 内存地址后的几个 字节;
### GNU　认为　void　＊ｐ 与 char    *p 类型一致
povid ++; pvoid += 1;//GNU 正确
(char*)pvoid++;//ANSI:正确    GNU：正确
(char*)pvoid+=1;//ANSI:错误    GNU：正确
void    *memcpy(void    *dest,const  void    *src,    size_t    len);
void    *memset(void    *buffer,int    c,    size_t    num);
上面 这两个函数都是操作一片内存，而不关心知道参数 指针 是什么类型
并且 其返回的也是任意类型的 指针
void     并不代表真实的值，它只是 值的一种抽象。知道有就够了
###return 语句
char    *Func(void)    {    cahr    str[30];    ...    return    str;    }
str    属于局部变量，位于栈内存中，在 Func    结束 的时候 被释放，所以 返回 str 将导致错误。
return    语句不可返回指向“栈内存” 的 “指针” , 因为 该内存 在函数体结束时 被 自动销毁。
return  ; 这个语句没有问题，只 表示 函数的结束 ;
###const 在 c 语言里只能作为 只读属性来解释
const 愿意是替代预编译指令 #define
\#define    M    3
const    int    N=5;    //此时并未将 N 放入 内存中
....
int    i= N;    //此时 为 N 分配内存，以后不再分配
int    I=M;    //预编译期间 进行宏替换 ，分配内存
int     j=N;    //使用    N    上次的内存
int     J=M;    //再进行宏替换，又一次分配内存 ！
const    与    define    之间的区别
        从 汇编 角度： const    给出的是变量对应的内存地址，所以在运行过程中只有一份，为只读变量 ，放在静态区，具有特定的类型
                             #define    给出的是立即数，宏是在预编译时进行替换，有若干个拷贝，没有类型
const    int    a[5]={1,2,3,4,5};
const    int    *p;    //修饰指针    p 可变，p指向的对象不可变    修饰 *P
int    const    *p;    //修饰指针    同上    修饰    *p
int    *const    p;    //p    不可变，p 指向的对象可变    修饰p
const    int    *const    p;    //指针 p 和 p 指向的对象 都不可变    修饰 * 修饰 p
编译器 解析时 忽略类型名，并且 const 离谁近 ，就修饰谁;
void    Fun(const    int    i); 告诉编译器，i 在函数体中 的值不能改变，从而防止了一些无意的修改
const    int     Fun(void);    //返回值不可 被改变
extern    const    int     i ;   //在 另一个文件中 引用 const 只读变量
extern    const    int j=10;    //错误，只读变量 的值 不能改变
c++ 里面对 const 还进行了扩展 ！T_T 搞 it 的不简单啊。。。。
###extern 外来变量函数引用
置于函数或者变量前，告诉编译器 此变量和函数 在其他模块（不在本文件）中 寻找其定义。
###struct 提供 数据类型打包功能
在 网络协议中 ,通信控制,嵌入式系统,驱动开发 等地方，我们传送的不是简单的字节流(char 型数组),而是多种数据组合起来的一个整体，其表现形式是一个结构体。
空结构体：一个字节大小，不可能造出 没有任何容量的容器吧
###Union 压缩空间用的
在 union 中 所有的 数据成员 共用一个空间，同一个时间只能储存其中一个数据成员，所有的数据成员具有相同的起始数据地址
union  StateMachine{ char  character;int number;char *str;double  exp;}
union 使用最大的的长度(double) 来储存所有成员，所以只能一个时间，存一个！
###编译器剔除代码
实际是将注释字段 ，换成 空格
/*/* 非法的 */*/  /* 总是与离它最近的 */ 的匹配
y=x/*p  ;   错误
y=x/ *p ;正确
###逻辑运算符短路
Ａ　＆＆　Ｂ　　：Ａ　若为假，Ｂ就不再判断了
Ａ    ｜｜　Ｂ    ：Ａ　若为真    Ｂ　就不再判断了
###前置++ 和 后置++
int i =3；
编译器区别：j=(++i)+(++i)+(++i)  //VC6 ：16    gcc ：18
j=(i++,i++,i++);    // 后置 ：5    先进行别的运算（赋值）再 ++
j=(i++,i++,++i);    // 前置 ：6    先 ++ 再赋值
/*
     上面是逗号表达式，i 在遇到每个逗号后，认为本计算单位已经结束，i 这时候++
*/
x=(++i,i++,i+10);    //    i=5    x=15
k=(i++)+(i++)+(i++);    // k=9    i=6
a+++b;// 等价于 a++  +b  ，符号的贪心原则：判定一个符号时，尽可能的包括多的字符
###define    NULL    0
int    *p=NULL;    意思是指向 内存0 地址
int    *j;    *j=NULL;    //将 *j 指向的值 赋值为 0

### c primier
p17 `#include` 是一种剪切和张贴操作，用于在多个程序间共享信息。
头文件里面放置常量或者变量等，但是函数的实际代码被包含在一个预编译好的库文件中，链接器负责找到程序所需要的库代码。而头文件指引编译器把程序正确的组合在一起。
p19 int 是一种数据类型。编译器使用这个信息为变量在内存中分配一个合适的存储空间。
p29 编程是一种富有挑战性的事情，它需要抽象的，概念性的思考并细致的对待细节问题！
p32 数据类型分为 ：整数类型 和 浮点数类型，字符是整数类型 ，是一种整数编码！
p35 标准定义的数据类型 ：K&R  :int  short  long  unsigned char   float  double
                                        c90 : void  signed
                                        c99 :_Bool  _Complex  _Imaginary  分别是  布尔值(true 和 false) 复数  和 虚数
p35  对于人，整数和浮点数的区别在于它们的书写。对于计算机，区别在于它们的存储方式。
p46  可移植的类型，在不同位数的计算机上，消除 short  int  long  等表示的范围大小不一致的问题。
        #include <inttypes.h>
        使用 int16_t 表示一个16位有符号整数类型，uint32_t 表示一个32位无符号整数类型
p48  c 标准规定 float 类型至少能精确表示 6位有效数字，double 至少能精确表示 13位有效数字。
        取值范围都是  10E-37  ~10E37
p50  如果包含了 complex.h 头文件，则你可以用 complex  代替 _Complex ,imaginary 代替 _Imaginary

p56 刷新输出
        printf 将输出传递给一个被称为 缓冲区（buffer）中间存储区域。在以下几种情况，缓冲区内容传递给屏幕或者文件。这称为 刷新缓冲区。
        a 缓冲区满时
        b 遇到换行符 ，\n
        c 需要输入的时候    scanf 或 getchar
p62  scanf 遇到空白字符串（空格，制表符，换行）处停止读取。
p66  可以使用 #define 定义常量，也可以使用 const 修饰，使一个变量成为常量。const  int  MONTHS = 12;
p68  io 函数 的格式说明符 ：%c 字符，%s 字符串，%d 整数，%f  浮点数 ，%p  指针  ,%x  十六进制数
p70  格式修饰符  %4d  使用4个字宽，%5.2f 5个字宽，小数点后两位
p76    printf 打印正确返回 字符数目，打印错误返回负数
p81   scanf  返回读入项目的个数，读错时返回0，检测到 “文件末尾” 返回 EOF

#C++和其他语言对比
##C++ 改进了c
* 使用内联 inline 函数，代替了宏替换
* 使用new 和delete 代替了 malloc() 和 free(),作为动态内存管理！优点：new 自动计算要分配类型的大小，不使用 sizeof 运算符。b，它自动返回正确的指针类型，不用进行强制类型转换。c，可以使用new 对分配的对象进行初始化。
* 函数重载，对于简化函数命名有作用！
* 对于确定不会被设置为 null 的变量，使用 引用 & 来代替 * ！在任何情况下都不能使用指向空值的引用！如果在设计中不允许变量为空，那推荐使用引用！
* STL : algorithm ,container,iterator +工具类
* 模板 : 解决了不需要根据不同参数类型，写重复代码的繁琐！
* 对于c语言的预处理，c++中引入了一些新的方法代替它们
##java
C++ 和java相比，只有标准的容器和算法，它的标准里没有网络，GUI以及应用框架这些内容，因此需要第三方的库来支持，如果你了解MFC，你就用知道qt和c++的关系其实 与 MFC和C++的关系一样，qt有完整的应用框架，GUI，网络等内容。



#作用域
## 局部作用域{}
```
int a = 5;
{int a = 10;printf("%f\n",a); // 10}
printf("%f\n",a);//5
```
#变量
##预指令
`#define TOES 20` 可以用预指令
`const int MONTHS = 12;`也可以用 const
##变量大小
`long a =100;sizeof(a);// 8` 说明 long 是8个字节,指针本身和数组名都是4字节
##变量真假
```
if (变量){...}
while(变量){...}
if(指针){...} //有指向的指针为真，没有的为假！
```
##变量的存储区
静态存储区：在程序开始执行时给全局变量分配存储区，程序行完毕就释放。在程序执行过程中它们占据固定的存储单元，而不动态地进行分配和释放
动态存储区：
函数形式参数：
自动变量（未加static声明的局部变量）
函数调用实的现场保护和返回地址。
对以上这些数据，在函数开始调用时分配动态存储空间，函数结束时释放这些空间。
在C语言中，每个变量和函数有两个属性：数据类型和数据的存储类别。
函数中的局部变量，如不专门声明为static存储类别，都是动态地分配存储空间的，数据存储在动态存储区中。
有时希望函数中的局部变量的值在函数调用结束后不消失而保留原值，这时就应该指定局部变量为“静态局部变量”，用关键字static进行声明。
对静态局部变量的说明：静态局部变量属于静态存储类别，在静态存储区内分配存储单元。在程序整个运行期间都不释放。而自动变量（即动态局部变量）属于动态存储类别，占动态存储空间，函数调用结束后即释放。静态局部变量在编译时赋初值，即只赋初值一次；而对自动变量赋初值是在函数调用时进行，每调用一次函数重新给一次初值，相当于执行一次赋值语句。如果在定义局部变量时不赋初值的话，则对静态局部变量来说，编译时自动赋初值0（对数值型变量）或空字符（对字符变量）。而对自动变量来说，如果不赋初值则它的值是一个不确定的值。
##static的作用？
这个简单的问题很少有人能回答完全。在C语言中，关键字static有三个明显的作用：
1). 在函数体，一个被声明为静态的变量在这一函数被调用过程中维持其值不变。
2). 在模块内（但在函数体外），一个被声明为静态的变量可以被模块内所用函数访问，但不能被模块外其它函数访问。它是一个本地的全局变量。
3). 在模块内，一个被声明为静态的函数只可被这一模块内的其它函数调用。那就是，这个函数被限制在声明它的模块的本地范围内使用。
大多数应试者能正确回答第一部分，一部分能正确回答第二部分，同是很少的人能懂得第三部分。这是一个应试者的严重的缺点，因为他显然不懂得本地化数据和代码范围的好处和重要性。
http://blog.chinaunix.net/uid-27661165-id-3550384.html 这篇博客太详细了！

##思考下同步执行和异步执行
在main 函数中的变量（可以称为全局变量了）var ;有 funcB(int *a);funcC(int *a); 可以修改该内存地址处的值。var 先后传入 funcB 和 funcC 。var 值 会先被 B 修改，再被 C 修改。var 的值是可以预测的。有先后顺序 是因为 ，在 执行 funB 未有返回值时，程序会阻塞在 funB 这里。
如果是 程序是如 node.js 般异步执行，var 的值就不再是可以预测的了。再说，如果funB 和funC 函数 再多几个，或者多调用几次，全局变量 var 的管理是非常复杂的。最好是分级管理： 全局变量级别，大函数级别，二级函数级别...
```
int a = 10; //全局变量
int func(){
    int a = 20 ; //局部变量，屏蔽全局变量
}
int func2(){
    printf('%d',a); // 函数内部可以直接使用全局变量
}
```
##常量const
const可以定义常量
const可以修饰函数的参数、返回值，甚至函数的定义体。被const修饰的东西都受到强制保护，可以预防意外的变动，能提高程序的健壮性。
```
const  其实是"只读"修饰符
const    int    nochange=11; /*nochange 为只读*/
nochange = 12;/*报错*/
const    int    days[12]={31,30,28,30,31,30,31,30,31,30,31,30};
/*数组的值是只读的了*/
const    float    *pf;或float    const    *pf    /*指针指向的值是不变的*/
float    *    const    pt;    /*指针不能变*/
const    float    *    const    pf;    /*指针和指针指向的值均不能变*/
void    display(const    int    array[],int    limit);    /*array指向的值是不能变的*/
void    display(const    int    *array,int    limit);    /*array指向的值是不能变的*/
char    *strcat(char    *,const    char*);
/*如果传入函数中的内存地址处的值只是用来 读取的，就const ;如果是要改变的，那就不加*/
```




#数组
## 定长数组
c中数组是连续的内存区域，是固定长度的
对于 c 的数组，未赋值的元素一律取 0
```
#define Y 5
int n;
const int N = 5;
int arr[n];/*错误*/
int arr[N];/*错误*/
int arr[Y];/*正确*/
```
##二维数组
只是概念上的，实际存储上还是线性连续的
`int a[5][3]={ {80,75,92}, {61,65,71}, {59,63,70}, {85,87,90}, {76,77,85} };`等价于`int a[5][3]={ 80,75,92,61,65,71,59,63,70,85,87,90,76,77,85};`
##字符数组
｀char c[]={'c', ' ','p','r','o','g','r','a','m'};｀等价于｀char c[]="C program";｀
数组类型是数组元素的类型，数组名是指向数组首地址的指针，scanf() 的参数列表必须是指针


# 指针
## 理解指针
指针记录的是"某数据结构"的"起始内存地址+指针类型",指针类型标明了该内存地址处的数据该如何读取,如：int型就该按4个字节依次读取
传递指针时，传递的是"内存地址+指针类型"
`int var = 10;`定义变量
`int* a　= &var;`定义指针
`*a`访问指针的值,`a+1`将内存地址加4
`short* b;`,`b+1`将内存地址加２,指针存储的内存地址的加减跟"指针类型"有直接关系
`int arr[3] = {1,2,3}`声明数组
`int* parr = arr` 声明指针指向数组
`printf("%d",*parr)` 输出1,`printf("%d",*(parr+1))`输出２　`printf("%d",parr[2]);`输出３
`*p++` : p先++再取值
`*++p` : 先取值，p再++
##数组与指针
`int arr[3] = {1,2,3}` arr为数组,也是指针常量,arr的值不可变,`arr++`是错误的
`int* prr = arr` 将arr赋值给prr指针,`prr++`正确
`*arr;*(arr+1);*(arr+2);`等价于` arr[0] arr[1] arr[2]`
`&arr[2]-&arr[0] = 2;`地址相差2
`int sum (int *ar,int n){}`等价于`int sum (int ar[],int n){}`传递数组的地址，从而在函数里操作数组，效率高！
###传递二维数组的地址
`func(int arr[][4],int length){}`  等价于 `func(int (*arr)[4],int length){}`
`(*arr)[4]` 是一个 指向列数为4的二维数组的指针,`arr+1` 就是移动 4*4 个字节
`*(*(index + 2)+1)` 等价于 `index[2][1]`
`int  (*pz)[2];`声明指向二维数组的指针
`int  *pax[2];`声明装有两个int型指针的数组;
`int array[][4] `定义二维数组
`int *p2array = array ;`二维数组的指针
`*(*(p2array+3)+2)`等价于 `array[3][2]` 等价于 `p2array[3][2]`



## 指针数组和二级指针
二级指针要认清层次
```
#include <stdio.h>
int main(int argc, char const *argv[])
{
    int arr[]={1,2,3,4,5};
    int *parr[5],i;
    int **pparr;
for (i = 0; i < 5; ++i)
{
    parr[i] = &arr[i];
}
for (i = 0; i < 5; ++i)
{
    printf("parr[%d]:%d\n",i,parr[i]);
}
pparr = parr;
printf("parr :%d pparr: %d\n",parr,pparr);
for (i = 0; i < 5; ++i)
{
    printf("%d\n", pparr[0][i]);
}
    return 0;
}
```
```
#include <stdio.h>
int main(int argc,char **argv){
    int a[5] = {1,3,4,5,9};
    int* p[5],i; //int* p[5] : 五个元素的数组,每个元素都是int类型的指针
    int** pp;
    pp = p;//将二级指针赋值为一个指针数组的地址
    for (i = 0; i < 5; ++i)
    {
        p[i] = &a[i];
    }
/*通过指针数组访问*/
    for (i = 0; i < 5; ++i)
    {
        printf("p[%d] :%d\n",i,p[i]);
        printf("*p[%d] :%d\n",i,*p[i]);
    }
/*通过二级指针访问数据*/
    for (i = 0; i < 5; ++i,pp++)
    {
        printf("**pp %d : %d\n",i,**pp);
    }
    getchar();
    return 0;
}
```
```
#include <stdio.h>
int main(int argc,char **argv){
    int a[2][5] = {1,3,5,7,9,2,4,6,8,10};
    int (*p)[5],i;//int (*p)[5]指向一个一维数组,该数组含有5个元素
    p = a;
    for (i = 0; i < 5; ++i)
    {
        printf("(*p)[%d] :%d\n",i,(*p)[i]);
    }
    p++;//地址移动了 int * 5 位
    for (i = 0; i < 5; ++i)
    {
        printf("(*p)[%d] :%d\n",i,(*p)[i]);
    }
    p = a;
    for (i = 0; i < 5; ++i)
    {
        printf("p[0][%d] :%d\n",i,p[0][i]);
    }
    for (i = 0; i < 5; ++i)
    {
        printf("p[1][%d] :%d\n",i,p[1][i]);
    }
    return 0;
}
```
##函数返回指针
```
#include <stdio.h>
char *name[7] = {"Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"};
char *message = "wrong input";
char* week(int day){ //返回指针的函数
    if (day<0 || day>7)
        return message;
    else
        return name[day - 1];
}
int main(int argc,char **argv){
    int day;
    char *p;
    printf("input a number of a week :\n");
    scanf("%d",&day);
    p = week(day);
    printf("%s\n",p);
    return 0;
}
```
## 指向函数的指针
```
#include <stdio.h>
#define GET_MAX 0
#define GET_MIN 1
int get_max(int i,int j){
    return i>j?i:j;
}
int get_min(int i,int j){
    return i>j?j:i;
}
int compare(int i,int j,int flag){
    int (*p)(int,int);//声明指向函数的指针
    if (flag == GET_MAX)
        p = get_max;//将函数赋值给函数指针
    else
        p = get_min;
    return p(i,j);//通过函数指针调用函数
}
int main(int argc,char **argv){
    printf("the min: %d",compare(3,4,GET_MIN));
    return 0;
}
```
将指向函数的指针作为形参
```
#include <stdio.h>
int get_big(int i,int j){
    return i>j?i:j;
}
int get_max(int i,int j,int k,int (*p)(int ,int))//将指向函数的指针int (*p)(int,int) 作为形参，传递函数
{　
    int ret;
    ret = p(i,j);//使用函数指针掉用函数，跟使用函数是一样的！
    ret = p(ret,k);
    return ret;
}
int main(int argc,char **argv){
    int i = 5,j = 10,k = 15,ret;
    ret = get_max(i,j,k,get_big);//将get_big函数传进去，在get_max里面调用
    printf("the max is %d\n",ret);
    return 0;
}
```
返回函数指针的函数
```
#include <stdio.h>
int get_big(int i,int j){
    return i>j?i:j;
}
int (*get_function(int a))(int ,int){
    printf("the number is %d \n",a);
    return get_big;
}
int main(){
    int i = 5,j = 10,max;
    int (*p)(int,int);//声明一个函数指针 p
    p = get_function(100);
    max = p(i,j);
    printf("the max is %d \n",max);
    return 0;
}
```
#结构体
将一些离散的数据打包放一起
```
typedef struct Student {char *name,int age}std,* pstd;//定义结构体struct Student,取别名为std
std st1 = {"codekissyoung",21}; //定义一个std结构体变量
pstd pst1 = &st1;    //定义一个std结构体指针,指向st1
st1.name = "hello li"; 结构体访问单个元素
pst->name; 通过结构体指针访问单个元素
```

#函数
##声明与定义
```
void swamp(int *x,int *y);//声明
int main(){...}
void swamp(int *x,int *y){....}//  定义
```
##递归函数
```
//n! = n * (n-1)!
long rfact(int n){
    long ans ;
    if(n>0){
        ans = n*rfact(n-1);
    }else{
        ans = 1;
    }
    return ans;
}
```
## 函数参数为指针
```
void swamp(int *x,int *y){
    int temp;
    temp = *x;
    *x = *y;
    *y = temp;
}
int a=10,b=20;
swamp(&a,&b);
```
`swamp(&34,&89);`*错误：因为不能对标量取地址
C语言中不允许作嵌套的函数定义。因此各函数之间是平行的，不存在上一级函数和下一级函数的问题。
所以，函数可以调用自身，也可以两个函数相互调用，但是一定要有退出条件，不能无限循环调用下去！
##数组作为函数的参数
数组元素作函数实参 ：跟普通变量没区别
数组名作为 参数 ：传递的是引用
```
#include <stdio.h>
float aver(float a[5]){
    int i;
    float av,s=a[0];
    for(i=1;i<5;i++)
        s=s+a[i];
    av=s/5;
    return av;
}
int main(void){
    float sco[5],av;
    int i;
    printf("\ninput 5 scores:\n");
    for(i=0;i<5;i++)
        scanf("%f",&sco[i]);
    av=aver(sco);
    printf("average score is %5.2f",av);
    return 0;
}
```
##二维数组作为参数
多维数组也可以作为函数的参数。在函数定义时对形参数组可以指定每一维的长度，也可省去第一维的长度。因此，以下写法都是合法的：`int MA(int a[3][10])`或`int MA(int a[][10])`或`int MA(int a[][10],n)`

## main 函数的输入
```
#include <stdio.h>
int main(int argc, char const *argv[])
{
 int count;
 printf("the command line has %d arguments\n",argc);
 for (count = 0;count < argc ;count++)
 {
  printf("%d : %s\n",count,argv[count]);
 }
 return 0;
}
/*    下面是输出 ：标准输入流会 被 切成 数组，每个元素以空格 区别
H:\c\code\面试题代码>a wowodlkfj heh ,hahi owem
the command line has 5 arguments
0 : a
1 : wowodlkfj
2 : heh
3 : ,hahi
4 : owem
H:\c\code\面试题代码>a "i am hungry now" hehe
the command line has 3 arguments
0 : a
1 : i am hungry now     //使用 引号 将输入变成...
2 : hehe
*/
```
##指针函数和函数指针
`double *fun();`() 的结合优先级高于 * ，所以 表达式实际为 `(*)(fun())`,表示 声明 函数返回值为double类型的指针
`double   (*fun)()`表示 *fun 是指针，指向函数名，表达式实际为：声明一个用指针指向函数名的函数的返回类型为 double

#动态内存(堆内存)
`int *pArr = (int *)malloc(sizeof(int)*len);`向系统申请堆内存
`free(pArr);`释放指针，把堆内存的控制权限还给系统
```
/*在 return_p 里面构造堆内存，返回地址给主调函数，这样主调函数就可以使用那块堆内存了*/
int* return_p(len){
    int *pArr = (int *)malloc(sizeof(int)*len);
    return pArr;
}
int main(int argc, char const *argv[])
{
    int len,i,*pArr;
    /*中间代码略*/
    pArr=return_p(len);
    free(pArr);/*释放指针，把堆内存的控制权限还给系统*/
}
```

```
/*通过传递指针的地址进去，改变指针指向的地址为函数构造堆内存*/
void pp_to_p(int **a,int len){
    /*int **a = a;*/
    *a = (int *)malloc(sizeof(int)*len);
}
int main(int argc, char const *argv[])
{
    int len,i,*pArr;
    /*中间代码略*/
    pp_to_p(&pArr,len);
    free(pArr);/*释放指针，把堆内存的控制权限还给系统*/
}
```
```
/*动态构造结构体*/
struct  Student
{
    int sid;
    int age;
};
struct Student *CreateStudent(){
    struct Student *s =(struct Student *)malloc(sizeof(struct Student));
}
void show_Student(struct Student *a){
    printf("%d %d\n",a->sid,a->age);
}
int main(int argc, char const *argv[])
{
    struct Student tom ={1,2};
    struct Student *ptim =CreateStudent();
    ptim->sid = 3;
    ptim->age = 45;
    show_Student(&tom);
    show_Student(ptim);
    return 0;
}
```



#二进制文件与文本文件区别
文本文件与二进制文件的区别并不是物理上的，而是逻辑上的。这两者只是在编码层次上有差异。简单来说，文本文件是基于字符编码的文件，常见的编码有ASCII编码，UNICODE编码等等。二进制文件是基于值编码的文件，你可以根据具体应用，指定某个值是什么意思（这样一个过程，可以看作是自定义编码。文本文件基本上是定长编码的(也有非定长的编码如UTF-8)。而二进制文件可看成是变长编码的，因为是值编码嘛，多少个比特代表一个值，完全由你决定。大家可能对BMP文件比较熟悉，就拿它举例子吧，其头部是较为固定长度的文件头信息，前2字节用来记录文件为BMP格式，接下来的8个字节用来记录文件长度，再接下来的4字节用来记录bmp文件头的长度。
文本工具打开一个文件的过程是怎样的呢？拿记事本来说，它首先读取文件物理上所对应的二进制比特流，然后按照你所选择的解码方式来解释这个流，然后将解释结果显示出来。一般来说，你选取的解码方式会是ASCII码形式（ASCII码的一个字符是8个比特），接下来，它8个比特8个比特地来解释这个文件流。例如对于这么一个文件流"01000000_01000001_01000010_01000011"(下划线''_''，为了增强可读性手动添加的)，第一个8比特''01000000''按ASCII码来解码的话，所对应的字符是字符''A''，同理其它3个8比特可分别解码为''BCD''，即这个文件流可解释成“ABCD”，然后记事本就将这个“ABCD”显示在屏幕上。
事实上，世界上任何东西要与其他东西通信会话，都存在一个既定的协议，既定的编码。人与人之间通过文字联络，汉字“妈”代表生你的那个人，这就是一种既定的编码。但注意到这样一种情况，汉字“妈”在日本文字里有可能是你生下的那个人，所以当一个中国人A与日本B之间用“妈”这个字进行交流，出现误解就很正常的。用记事本打开二进制文件与上面的情况类似。记事本无论打开什么文件都按既定的字符编码工作（如ASCII码），所以当他打开二进制文件时，出现乱码也是很必然的一件事情了，解码和译码不对应嘛。例如文件流''00000000_00000000_00000000_00000001''可能在二进制文件中对应的是一个四字节的整数int 1，在记事本里解释就变成了"NULL_NULL_NULL_SOH"这四个控制符。
文本文件的存储与其读取基本上是个逆过程。而二进制文件的存取显然与文本文件的存取差不多，只是编／解码方式不同而已

#stdio标准输入输出
各个操作系统底层对文件的操作都是不一样的，如windows 的 ntfs 和linux 的 ext3 ！
stdio.h 屏蔽了这种不同，使用了流来管理文件！键盘输入由 一个称为stdin 的流表示，而到屏幕上输出 由一个stdout 的流表示。还有一个 stderr 标准错误流。
```
#define    EOF    （-1）    // 这个判断文件流到达末尾的标志符
#include <stdio.h>
int main(){
  char ch;
  while((ch=getchar()) != EOF )  //getchar 是从输入流中读取一个字符
  putchar(ch);    //输出一个字符
  return 0;
}
```
输入输出重定向：< 是输入 > 是输出，>>是追加输出！
`H:\c\code\面试题代码>echo.exe < echo.c >echo.txt` 将 echo.c 输出到 echo.txt
输入和输出缓存：现在操作系统都会提供输入缓存，键盘输入的话，敲击 enter 才会将缓存的数据真正输入到程序！(数据后面还有跟有 一个 '\n' )。
如果输入的是文件，检测到文件末尾时，scanf 和 getchar 都返回 EOF 值。如果是键盘输入，能用 Ctrl + D 或者 Ctrl + z 来模拟从键盘模拟文件结束条件。
c程序将输入视为一个外来字节的流，getchar() 函数将每个字节解释为一个字符编码。scanf()函数将以同样的方式看待输入，但在其转换 说明符的指导下，该函数可以将字符转换为数值。如果scanf 读取失败，它会将数据还给字节流。
```
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
# c函数

###输入函数
```
scanf("%s",&name); 读取缓存中的字符串，会在空白 ，\t,\n 处停止读取！
scanf("%d,%d",&grade,&age); //表示 期望我们以： 3,12 这样的形式输入
```
###输出函数
```
prinf("%d %s %p",10,"caokaiyan",point);//point 是一个指针
```
所有输出的内容都是先存放到缓冲区，再由缓冲区一次性输出到屏幕。缓冲区在满了、遇到换行符或者需要输入的时候将内容打印到屏幕！
###字符串函数
```
strlen("caokaiyan"); // 9 返回字符个数
```
```
char ch;
while((ch = getcahr()) != EOF){
    putchar(ch);
}
```
* 定义字符串
```
   char *str  = "caokaiyan";
   char str[] = "caokaiyan";
   printf("%s",str);
```
* 区别字符类型和字符串
```
char ch = "A"; //错误
char ch = 'A'; //正确
const char *ch  = "A";//正确
const char *ch = 'ch'; //错误
```
### 数值
* 判断浮点数为0
```
const float EPSINON = 0.00001;
if ((x >= - EPSINON) && (x <= EPSINON))
```
* 判断指针为空
```
if (p == NULL)
if (p != NULL)
```
* 一段二进制 00000000 代表什么
```
整数值 0    字符串结束标记符
‘\0’    NULL本质也是 0 （stdio.h 中 #define NULL  0）
int  *P =NULL ; //表示指向的内存单元 的编号为
0    计算机规定，以0为编号的存储单元不可读，不可写
```
### 指针
* 声明指针必须初始化，不用后记得释放
```
char *str = malloc(10); //初始化,malloc 返回的是 10个字节大小的一块内存区域的 void 类型指针，可以使用强制类型转换将它转换为任意类型。
free(str);
```

#数据结构
它要解决的核心问题是 数据 关系 的存储！我们的内存都是线性的，如何在线性的内存上保存 一颗数？保存一幅图？
##链表
链表:头节点，首节点，尾节点，头指针，尾指针
```
/*构造链表节点*/
typedef struct Node{
    int data;//数据域
    struct Node * pNext; //指针域，指针的类型是，这个节点对象本身！（不用理解，直接记住就好）
}*pNode ,Node; //pNode 等价于 struct Node * ,Node 等价于  struct Node
```
