# 匿名半双工管道
```c
#define PIPE_BUF 255
int main( int argc, char* argv[] )
{
    int fd[2];
    pipe( fd ); // 创建匿名半双工管道
    pid_t pid = fork();
    if( pid > 0 ) 
    {   
        close( fd[0] ); // 父进程关闭 读出端
        write( fd[1] , "hello my son \n ",14);
        exit(0);
    }   
    else
    {   
        close( fd[1] ); // 子进程关闭 写入端
        char buf[ PIPE_BUF ];
        int len = read( fd[0], buf, PIPE_BUF );

        write( STDOUT_FILENO, buf, len );
        exit(0);
    }   
}
```
- 数据只能在一个方向移动
- 只能在有公共祖先的进程间通信，比如父子进程，兄弟进程
- `fd[2]`是一个文件描述符数组，`fd[0]`是读出端，`fd[1]`是写入端

# FIFO 有名管道 (进程通信代码并没有达到预期的效果)
```c
#include <sys/types.h>
#include <sys/stat.h>
int mkfifo(const char *filename, mode_t mode); # 创建有名管道
```
```c
#define BUFES PIPE_BUF

int main( int argc, char* argv[] )
{
    int fd; 
    int len = 0;
    char buf[BUFES];

    if( ( fd = open( "/home/cky/workspace/C/IPC/fifo1", O_RDONLY ) ) < 0 ) 
    {   
        perror("open error\n");
        exit(1);
    }   

    while( ( len = read( fd, buf, BUFES ) ) > 0 ) 
    {   
        printf("read info from fifo1 : %s\n", buf );
    }   
    printf("hehe");
    close( fd );
    return 0;
}
```
```c
#define BUFES 256

int main( int argc, char* argv[] )
{
    int fd;
    int n,i;
    char buf[BUFES];
    time_t tp;

    printf("I am %d \n", getpid() );

    if( ( fd == open( "/home/cky/workspace/C/IPC/fifo1",O_WRONLY) ) < 0 )
    {
        perror("open");
        exit(1);
    }
    for( i = 0; i < 10; i++ )
    {
        time( &tp );
        n = sprintf( buf, "write info : %d sends %s", getpid(), ctime(&tp) );

        if( write( fd, buf, n + 1 ) < 0 )
        {
            perror("write error\n");
            close( fd );
            exit(1);
        }
        sleep( 3 );
    }
    close( fd );
    exit(0);
}
```
- 可以用于不相关的进程之间
- [参考](https://www.cnblogs.com/fangshenghui/p/4039805.html)

# System V IPC / POSIX IPC
- 基于系统内核
- IPC 对象 : 消息队列 , 信号量 , 共享存储器
- `ipcs -a` 查看系统内IPC的状态
- 缺陷: 不使用通用的文件系统 , 缺少资源回收机制, IPC 对象创建然后退出时, 没有被自动回收

## 共享内存

## 信号量

## 消息队列