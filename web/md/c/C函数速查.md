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


# 系统时间
```c
#include <time.h>
time_t time(time_t *t);
```


# 总结
- `open()` 获取文件描述符
- `read()` 和 `write()` 执行文件 I/O操作
- `close()` 释放文件描述符 及 相关资源
- **文件偏移量** : 记录的读写的的位置，每次读写操作都会修改偏移量的值，使用 `lseek()` 可以显式修改偏移量的值
- **文件空洞** : 概念比较复杂，暂时不理解
- `ioctl(int fd,int cmd,[struct])` : 暂时不理解

# 原子操作 和 竞争条件
- 所有系统调用都是以原子操作方式执行的，内核保证了系统调用中的所有步骤会作为独立操作而一次性加载执行，期间不会被其他进程和线程中断
- 独占方式创建文件的竞态条件
- 向文件结尾追加数据的竞态条件

# lseek 系统调用
- 设置文件描述符读写的位置
- whence 取值 `SEEK_SET` `SEEK_CUR` `SEEK_END`
```c
#include <unistd.h>
#include <sys/types.h>
off_t lseek( int fildes, off_t offset, int whence );
```

# 获取文件状态
```c
#include <unistd.h>
#include <sys/stat.h>
#include <sys/types.h>
int fstat( int fildes, struct stat *buf );
int stat( const char *path, struct stat *buf );
int lstat( const char *path, struct stat *buf );
```

# dup 和 dup2 系统调用
- 复制文件描述符，使我们可以通过多个文件描述来访问同一个文件
```c
#include <unistd.h>
int dup( int fildes );
int dup2( int fildes, int fildes2 );
```

# 标准输入输出流函数
```c
// 格式化输入
int scanf( const char *format, ... );
int fscanf( FILE *stream, const char *format, ... );
int sscanf( const char *s, const char *format, ... );
// 格式化输出
int printf( const char *format, ... );
int sprintf( const *s, const char *format, ... );
int fprintf( FILE *stream, const char *format, ... );
// 从文件流里取一个字符
int fgetc( FILE *stream );
int getc( FILE *stream );
int getchar();
// 写一个字符到输出文件流中
int fputc( int c, FILE *stream );
int putc( int c, FILE *stream );
int putchar( int c );
// 从文件流里 读取一个字符串
char *fgets( char *s, int n, FILE *stream );
char *gets( char *s );
// 获取文件流当前读写位置
fgetpos();
// 设置文件流当前读写位置
fsetpos();
// 返回文件流当前读写位置的偏移值
ftell();
// 重置文件流里的读写位置
rewind();
// 重新使用一个文件流
freopen();
// 设置文件流的缓冲机制
setvbuf();
// 删除文件 目录
remove();
```

# 文件流错误
```c
#include <errno.h>
#include <stdio.h>
extern int errno;
// 测试一个文件流的错误标识
int ferror( FILE *stream );
// 测试一个文件流的 末尾标识
int feof( FILE *stream );
// 清除文件流的末尾标识 和 错误标识
void clearerr( FILE *stream );
// 查看文件流使用的是哪个文件描述符
int fileno( FILE *stream );
// 在一个打开的文件描述符上，创建一个新的文件流
FILE *fdopen( int fildes, const char *mode );
```

# 文件状态维护
```c
#include <sys/stat.h>
#include <sys/types.h>
#include <unistd.h>
int chmod( const char *path, mode_t mode );
int chown( const char *path, uid_t owner, gid_t group);
int unlink( const char *path ); // 删除一个文件
int link( const char *path1, const char *path2 ); // 创建一个硬连接
int symlink( const char *path1, const char *path2 ); // 创建一个软连接
```

# 目录
```c
#include <sys/types.h>
#include <sys/stat.h>
#include <unistd.h>
// 创建目录
int mkdir( const char *path, mode_t mode );
// 删除目录
int rmdir( const char *path );
// 改变当前工作目录
int chdir( const char *path );
// 获取当前工作目录
char *getcwd( char *buf, size_t size );
```

# 扫描目录
```c
#include <sys/types.h>
#include <dirent.h>
// 打开目录 建立一个目录流
DIR *opendir( const char *name );
// 返回一个指针 ，它保存着目录流里下一个目录项的有关资料
struct dirent *readdir( DIR *dirp );
// 记录着目录流里的当前位置
long int telldir( DIR *dirp );
// 设置目录流dirp的目录项指针
void seekdir( DIR *dirp, long int loc );
// 关闭并且释放一个目录流
int closedir( DIR *dirp );
```

# 错误处理
```c
#include <string.h>
char *strerror( int errnum );
void perror( const char *s );
```

# fcntl 系统调用
```c
- 对文件描述符号进行各种操作，包括 复制，获取，设置文件描述符标志，设置文件状态标志，管理文件锁
#include <fcntl.c>
int fcntl( int fildes, int cmd );
int fcntl( int fildes, int cmd, long arg );
```

# mmap 系统调用
- 建立一段可以被两个以上进程读写的内存，一个进程对该内存进行的修改也可以被其他进程看见
- 用在文件处理，使磁盘文件的全部内容看起来就像是在内存一样，通过更新这内存就可以更新文件了
- mmap 创建一个指向一段内存区域的指针，该内存区域 与 通过 **文件描述符** 访问的文件的内容关联
```c
#include <sys/mman.h>
void *mmap( void *addr, size_t len, int prot, int flags, int fildes, off_t off );
// 把内存段的某个部分 或者 整段中的修改 写回被映射的文件中
int msync( void *addr, size_t len, int flags );
// 释放内存段
int munmap( void *addr, size_t len );
```
