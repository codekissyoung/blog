# `int getopt(int argc,char * const argv[ ],const char * optstring)`
```c
#include <unistd.h>
extern char *optarg; //选项的参数指针  
extern int optind; //下一次调用getopt的时，从optind存储的位置处重新开始检查选项。
extern int opterr; //当opterr=0时，getopt不向stderr输出错误信息。  
extern int optopt; //当命令行选项字符不包括在optstring中或者选项缺少必要的参数时，该选项存储在optopt中，getopt返回 ?
int getopt(int argc,char * const argv[ ],const char * optstring);
```
- `a:b:cd::e`，这就是一个选项字符串。对应到命令行就是-a ,-b ,-c ,-d, -e 。冒号又是什么呢？
- 冒号表示参数，一个冒号就表示这个选项后面必须带有参数（没有带参数会报错哦），但是这个参数可以和选项连在一起写，也可以用空格隔开，比如`-a123` 和`-a 123`（中间有空格） 都表示`123`是`-a`的参数；
- 两个冒号的就表示这个选项的参数是可选的，即可以有参数，也可以没有参数，但要注意有参数时，参数与选项之间 **不能有空格**

# `time_t time(time_t *t)`
- 系统时间

# `int dup( int fildes )`
# `int dup2( int fildes, int fildes2 )`
- 复制文件描述符，使我们可以通过多个文件描述来访问同一个文件


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
int chmod( const char *path, mode_t mode );
int chown( const char *path, uid_t owner, gid_t group);
int unlink( const char *path ); // 删除一个文件
int link( const char *path1, const char *path2 ); // 创建一个硬连接
int symlink( const char *path1, const char *path2 ); // 创建一个软连接
```

# 目录
```c
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
void perror(const char *msg);  // 打印错误信息
char *strerror( int errnum);   // 将给定错误号 转换为 错误字符串
```

# mmap 系统调用
```c
#include <sys/mman.h>
void *mmap( void *addr, size_t len, int prot, int flags, int fildes, off_t off );
// 把内存段的某个部分 或者 整段中的修改 写回被映射的文件中
int msync( void *addr, size_t len, int flags );
// 释放内存段
int munmap( void *addr, size_t len );
```
- 建立一段可以被两个以上进程读写的内存，一个进程对该内存进行的修改也可以被其他进程看见
- 用在文件处理，使磁盘文件的全部内容看起来就像是在内存一样，通过更新这内存就可以更新文件了
- mmap 创建一个指向一段内存区域的指针，该内存区域 与 通过 **文件描述符** 访问的文件的内容关联


# 进程相关
```c
pid_t getpid(void);  // 获取当前进程 ID
pid_t getppid(void); // 获取当前进程的 父进程ID
uid_t getuid(void);  // 当前进程的 用户ID
uid_t geteuid(void); // 当前进程的 有效用户ID
gid_t getgid(void);  // 当前进程的 组ID
gid_t getegid(void); // 当前进程的 有效组ID
```

# 创建新进程
```c
if( ( pid_t pid = fork() ) > 0 )
{
    // 父进程
}
else if( pid == 0 )
{
    // 子进程
}
else
{
    // 创建新进程失败
}
```