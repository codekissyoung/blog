# 切换文本和图形界面
- `Ctrl + Alt + F1` 切换到第一个文本界面,总共有六个
- `Ctrl + Alt + F7` 切换到图形界面

# 安装bash自动补全工具
```
➜  blog git:(master) ✗ sudo apt-get install bash-builtins bash-completion bash-doc bash-static
```

# 限制用户进程数
- 在`/etc/security/limits.conf` 文件后面添加上下面代码，限制用户进程数为200
    ```
    *   hard    nproc   200
    ```

# linux用于完成特定任务的用户
- `nobody` `admin` `ftp` ，无密码,无home目录，无shell,主要就是为了运行某些特定的进程，比如 nginx 使用nobody用户来运行


# 特殊权限
```
000 , --- , 0 , 不使用任何特殊权限
001 , --t , 1 ,
010 , -s- , 2 ,
011 , -st , 3 ,
100 , s-- , 4 ,
101 , s-t , 5 ,
110 , ss- , 6 ,
111 , sst , 7 ,
```

```
➜  ~ ls -alh /bin/su
-rwsr-xr-x 1 root root 40K 5月  16 10:28 /bin/su
```
- s 特殊权限
- 只对二进制程序有效 , 执行者拥有该程序的执行权限，且只在执行该程序的过程中有效
- 执行者将具有该程序拥有者的权限，比如 su 的 s 权限,可以让用户暂时拥有 root 用户的权限
- 通过 `chmod u+s file` 或者 `chmod 4755 file` 来设置


```
➜  ~ ls -alh /usr/bin/mlocate
-rwxr-sr-x 1 root mlocate 39K 11月 18  2014 /usr/bin/mlocate
```
- SGID 权限,与 s 权限相同，不同的是，SGID在执行过程中还会得到该程序的用户组的支持
- 对于设置了SGID权限的目录来说,用户拥有r x权限时，可以进入该目录,用户在此目录下的有效用户变为该目录的用户，创建的文件的所属用户也是该目录的用户
- 使用 `chmod g+s file` 来添加此权限

```
➜  / ls -alh / |grep tmp
drwxrwxrwt  16 root root 4.0K 6月   3 13:01 tmp
```
- SBIT 权限, `--t` ,该权限只对目录有效,用户在该目录下创建的文件或目录，权限默认为`-rw-r--r--`,即只有该用户和root可以删除
- 使用命令 `chmod o+t /tmp` 来添加此权限
