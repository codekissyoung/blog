# 原理
使用一种被称为 **公私钥** 认证的方式来进行ssh登录. **公私钥** 认证方式简单的解释是首先在客户端上创建一对公私钥 （公钥文件：`~/.ssh/id_rsa.pub` 私钥文件`~/.ssh/id_rsa`）然后把公钥放到服务器上（`~/.ssh/authorized_keys`）, 自己保留好私钥,当ssh登录时,ssh程序会发送私钥去和服务器上的公钥做匹配.如果匹配成功就可以登录了

# server
`/etc/init.d/ssh restart`  启动 ssh
`netstat -tlp` 判断ssh是否运行，检测到`tcp6 0 0 *:ssh *:* LISTEN`就说明启动成功
`sudo systemctl restart sshd.service` centos7.2 使用
如果用户目录下没有`.ssh`目录 ,则可以使用`ssh-keygen -t rsa`创建下,不要自己`mkdir`

# client
`ssh caokaiyan@192.168.0.103`登录服务器
`ssh-keygen -t rsa`生成密钥对
`ssh -t hostA ssh hostB` 直接连接到只能通过主机B连接的主机A 当然，你要能访问主机A才行

# login without password
在客户端 `ssh-copy-id user@host`
如果没用则手动添加
`scp .ssh/id_rsa.pub chenlb@192.168.1.181:/home/chenlb/id_rsa.pub `
`cat id_rsa.pub >> .ssh/authorized_keys`
`chmod 600 .ssh/authorized_keys`


# transmit file
`scp /home/daisy/full.tar.gz 　root@172.19.2.75:/home/root` 把当前一个文件copy到远程另外一台主机上
`scp shuidao@123.56.113.80:/home/shuidao/submail_statistic/* 　./`把文件从远程主机copy到当前系统

# 持久连接
Create persistent(持久) connections to the destination host(目标主机)
edit `etc/ssh/ssh_config`
```
ServerAliveInterval 60  #client每隔60秒发送一次请求给server，然后server响应，从而保持连接
ServerAliveCountMax 3  #client发出请求后，服务器端没有响应得次数达到3，就自动断开连接，正常情况下，server不会不响应
```
or edit etc/ssh/sshd_config on server .this need restart ssh serve
```
ClientAliveInterval 60 #server每隔60秒发送一次请求给client，然后client响应，从而保持连接
ClientAliveCountMax 3 #server发出请求后，客户端没有响应得次数达到3，就自动断开连接，正常情况下，client不会不响应
```
在后台创建到目标主机的持久化连接，将这个命令和你~/.ssh/config中的配置结合使用：
```
Host host
ControlPath ~/.ssh/master-%r@%h:%p
ControlMaster no
```

所有到目标主机的SSH连接都将使用持久化SSH套接字，如果你使用SSH定期同步文件（使用rsync/sftp/cvs/svn），这个命令将非常有用，因为每次打开一个SSH连接时不会创建新的套接字
* 通过SSH连接屏幕,直接连接到远程屏幕会话（节省了无用的父bash进程）
ssh -t remote_host screen –r
* 通过SSH将MySQL数据库复制到新服务器
`mysqldump –add-drop-table –extended-insert –force –log-error=error.log -uUSER -pPASS OLD_DB_NAME | ssh -C user@newhost "mysql -uUSER -pPASS NEW_DB_NAME"`
通过压缩的SSH隧道Dump一个MySQL数据库，将其作为输入传递给mysql命令，我认为这是迁移数据库到新服务器最快最好的方法
* 实时SSH网络吞吐量测试
yes | pv | ssh $host “cat > /dev/null” (首先要apt-get install pv)

# 25个必须记住的SSH命令
http://blog.urfix.com/25-ssh-commands-tricks/　
