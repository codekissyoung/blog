# SOCK_STREAM
- 表示面向连接的数据传输方式数据 可以准确无误地到达另一台计算机，如果损坏或丢失，可以重新发送，但效率相对较慢常见的 http 协议就使用 SOCK_STREAM 传输数据，因为要确保数据的正确性，否则网页不能正常解析

# SOCK_DGRAM
- 表示无连接的数据传输方式 计算机只管传输数据，不作数据校验，如果数据在传输中损坏，或者没有到达另一台计算机，是没有办法补救的也就是说，数据错了就错了，无法重传因为 SOCK_DGRAM 所做的校验工作少，所以效率比 SOCK_STREAM 高

# AF_INET
- 表示 IPv4 地址，例如 `127.0.0.1`

# AF_INET6
- 表示 IPv6 地址，例如 `1030::C9B4:FF12:48AA:1A2B`

# IPPROTO_TCP
- TCP 传输协议

# IPPTOTO_UDP
- UDP 传输协议

```c
int tcp_socket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP); // TCP 套接字
int udp_socket = socket(AF_INET, SOCK_DGRAM, IPPROTO_UDP);  // UDP 套接字
```

# 链接
```c
int connect(int sock, struct sockaddr *serv_addr, socklen_t addrlen);
```
