# 文件IO相关函数

## `int dup( int fildes )`

## `int dup2( int fildes, int fildes2 )`

- 复制文件描述符，使我们可以通过多个文件描述来访问同一个文件

## 标准输入输出流函数

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


## 文件流错误

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

## 文件状态维护

```c
int chmod( const char *path, mode_t mode );
int chown( const char *path, uid_t owner, gid_t group);
int unlink( const char *path ); // 删除一个文件
int link( const char *path1, const char *path2 ); // 创建一个硬连接
int symlink( const char *path1, const char *path2 ); // 创建一个软连接
```