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
