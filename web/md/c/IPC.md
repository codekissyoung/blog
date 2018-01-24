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