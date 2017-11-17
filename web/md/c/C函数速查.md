```c
#include <gnu/libc-version.h>
const char *gnu_get_libc_version(void); // 获取 glibc 的版本
```

```c
#include <stdio.h>
void perror(const char *msg); // 打印错误信息

#include <string.h>
char *strerror(int errnum); // 将给定错误号 转换为 错误字符串
```

```c
#include<unistd.h>
extern char *optarg; //选项的参数指针  
extern int optind; //下一次调用getopt的时，从optind存储的位置处重新开始检查选项。   
extern int opterr; //当opterr=0时，getopt不向stderr输出错误信息。  
extern int optopt; //当命令行选项字符不包括在optstring中或者选项缺少必要的参数时，该选项存储在optopt中，getopt返回 ?
int getopt(int argc,char * const argv[ ],const char * optstring);
```
- `a:b:cd::e`，这就是一个选项字符串。对应到命令行就是-a ,-b ,-c ,-d, -e 。冒号又是什么呢？
- 冒号表示参数，一个冒号就表示这个选项后面必须带有参数（没有带参数会报错哦），但是这个参数可以和选项连在一起写，也可以用空格隔开，比如`-a123` 和`-a 123`（中间有空格） 都表示`123`是`-a`的参数；
- 两个冒号的就表示这个选项的参数是可选的，即可以有参数，也可以没有参数，但要注意有参数时，参数与选项之间 **不能有空格**
