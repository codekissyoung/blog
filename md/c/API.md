# `int open(const char *pathname, int flags, mode_t mode)`
- flags 掩码参数 取值如下
    - O_RDONLY 只读
    - O_WRONLY 只写
    - O_RDWR   可读可写
    - O_APPEND 追加
    - O_CREAT  文件不存在就创建
    - O_DIRECT 无缓冲的 输入或者输出
    - O_EXCL   配合 O_CREAT , 表示只创建文件
    - O_NOATIME 不要修改文件最近访问时间
    - O_NOCTTY  如果 pathname 是终端(/dev/tty)的话，不要让它成为控制终端
    - O_NOFOLLOW 对软连接不解析
    - O_TRUNC  截断已有文件，使其长度为 0 
    - O_ASYNC  当 IO 操作可行时，产生信号 通知进程
    - O_DSYNC  提供 同步 IO 数据完整性
    - O_NONBLOCK  以非阻塞方式打开
    - O_SYNC      以同步方式写入文件
- 如果创建了文件，mode 参数才起作用，用于表示创建的文件的权限
    - 比如如果我们输入一个0664，表示的就是0000 000 110 110 100，等价于 `-rw-rw-r--`
    - 比如我想设置一个 `-rwsr-xr-x` 的权限，先变成二进制，就是0000 100 111 101 101，然后变成八进制，04755，这样直接设置就好了

# `ssize_t read( int fd, void *buffer, size_t count )`
- fd 文件描述符
- buffer 用于存放读取到的数据的内存缓冲地址 ，比如 `char buffer[20]` ,填入 buffer
- count  指定最多能读取到的字节数
- return 实际读取到的字节数

# `ssize_t write( int fd, void *buffer, size_t count )`
- fd ： 文件描述符
- buffer ： 要写入文件中数据的内存地址
- count ： 从 buffer 写入文件的数据字节数
- return : 实际写入文件的字节数

# `int close( int fd )`
- 功能: 关闭一个打开的 文件描述符

# `off_t lseek( int fd, off_t offset, int whence )`
- 功能: 对于打开的文件，内核会记录它的文件偏移量，也就是下一次 read() 和 write() 操作的文件起始位置，而 lseek 就是用来人为改变这个位置的
- fd 文件描述符
- offset 偏移的字节数，负数就表示往左 偏移
- whence
    - SEEK_SET 从文件头开始偏移
    - SEEK_CUR 从当前 文件偏移量处 开始偏移
    - SEEK_END 从文件尾部 开始偏移
- **文件空洞** : 如果使用 lseek 使文件偏移量超过了 文件末尾，那么 [文件末尾,文件偏移量] 中间这段空间，就称之为 **文件空洞**
    - 读取空洞: 将返回 空字节 填充的缓存区
    - 写入空洞：文件系统会为之分配磁盘块， 应用：核心转储文件 core 文件就是包含文件空洞的常见例子  


# `int ioctl( int fd, int request, ... )`
- 功能: 为执行文件 和 设备操作提供了 多用途机制
- fd 文件描述符
- request 指定在 fd 上执行控制操作
- ... 根据 request 的参数来 填入的不定参数

# `int fcntl( int fd, int cmd, ... )`
- 对文件描述符号进行各种操作，包括 复制，获取，设置文件描述符标志，设置文件状态标志，管理文件锁

# `const char *gnu_get_libc_version(void)`
- 获取 glibc 的版本

# `int getopt(int argc,char * const argv[ ],const char * optstring)`
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

# `time_t time(time_t *t)`
- 系统时间

# `int fstat( int fildes, struct stat *buf )`
# `int stat( const char *path, struct stat *buf )`
# `int lstat( const char *path, struct stat *buf )`
- 获取文件状态

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