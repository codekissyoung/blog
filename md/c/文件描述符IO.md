# 文件描述符 fd
- 进程要操作文件，需要通过内核系统调用，在进程和文件之间建立一条连接，这个连接用一个数字指代，这个数字就是文件描述符

# 获得文件描述符 fd
#### `int open( 路径, int flags, mode_t mode)`
- flags 掩码参数 取值如下
    - O_RDONLY 只读  / O_WRONLY 只写 / O_RDWR 可读可写 / O_APPEND 追加
    - O_CREAT  文件不存在就创建 / O_EXCL 配合 O_CREAT , 表示只创建文件
    - O_DIRECT 无缓冲的 输入或者输出 
    - O_NOATIME 不要修改文件最近访问时间
    - O_NOCTTY  如果 pathname 是终端(/dev/tty)的话，不要让它成为控制终端
    - O_NOFOLLOW 对软连接不解析
    - O_TRUNC  截断已有文件，使其长度为 0 
    - O_ASYNC  当 IO 操作可行时，产生信号 通知进程
    - O_DSYNC  提供 同步 IO 数据完整性 / O_NONBLOCK  以非阻塞方式打开 / O_SYNC 以同步方式写入文件
- 如果创建了文件，mode 参数才起作用，用于表示创建的文件的权限
    - 比如如果我们输入一个0664，表示的就是0000 000 110 110 100，等价于 `-rw-rw-r--`
    - 比如我想设置一个 `-rwsr-xr-x` 的权限，先变成二进制，就是0000 100 111 101 101，然后变成八进制，04755，这样直接设置就好了

# 设置文件描述符 属性
- `int fcntl( int fd, int cmd, ... )`
- 复制一个现有的描述符 cmd = F_DUPFD
- 获得/设置文件描述符标记 cmd = F_GETFD / FSETFD
- 获得/设置文件状态标志 cmd = F_GETFL / F_SETFL
- 获得/设置异步I/O所有权 cmd = F_GETOWN / F_SETOWN
- 获得/设置记录锁 cmd = F_GETLK / F_SETLK / F_SETLKW


# 使用文件描述符
#### 从文件中读取数据
- `实际读取字节数 read( fd, 接收数据的内存 buffer, 读取字节数 len )`
- buffer : 可以是数组 : `char buffer[20]` 或是结构体变量 `struct utmp buffer`
- len  :  一般就计算出 buffer 的大小 `sizeof(buffer)`

#### 往文件中写数据
- `实际写入的字节数 write( fd, 写入的数据源 buffer, 从数据源写入文件的字节数 )`
- buffer : 可以是数组 : `char buffer[20]` 或是结构体变量 `struct utmp buffer`
- len  :  一般就计算出 buffer 的大小 `sizeof(buffer)`

#### 文件偏移量
- 对于打开的文件，内核会记录它的文件偏移量，也就是下一次 `read` 和 `write` 操作的文件起始位置

#### 改变文件偏移量
- `off_t lseek( fd, 偏移的字节数, [ SEEK_SET | SEEK_CUR | SEEK_END ]  )`
- SEEK_SET 从文件头开始偏移
- SEEK_CUR 从当前 文件偏移量处 开始偏移
- SEEK_END 从文件尾部 开始偏移

#### 文件空洞
- 如果使用 lseek 使文件偏移量超过了 文件末尾，那么 [文件末尾,文件偏移量] 中间这段空间，就称之为 **文件空洞**
- 读取空洞: 将返回 空字节 填充的缓存区
- 写入空洞：文件系统会为之分配磁盘块， 应用：核心转储文件 core 文件就是包含文件空洞的常见例子

# `int ioctl( int fd, int request, ... )`
- 功能: 为执行文件 和 设备操作提供了 多用途机制
- fd 文件描述符
- request 指定在 fd 上执行控制操作
- ... 根据 request 的参数来 填入的不定参数

# 销毁 fd
- `int close( int fd )`
- 功能: 关闭一个打开的 文件描述符

