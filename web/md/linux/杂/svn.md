# 安装svn服务器
```shell
sudo apt-get install subversion
```

# 在服务器建立中心库 /home/cky/svn
```
svnadmin create /home/cky/svn
```

# 目录概述
```
➜  svn tree
.
├── conf
│   ├── authz
│   ├── hooks-env.tmpl
│   ├── passwd
│   └── svnserve.conf
├── db
│   ├── current
│   ├── format
│   ├── fsfs.conf
│   ├── fs-type
│   ├── min-unpacked-rev
│   ├── revprops
│   │   └── 0
│   │       └── 0
│   ├── revs
│   │   └── 0
│   │       └── 0
│   ├── transactions
│   ├── txn-current
│   ├── txn-current-lock
│   ├── txn-protorevs
│   ├── uuid
│   └── write-lock
├── format
├── hooks
│   ├── post-commit.tmpl
│   ├── post-lock.tmpl
│   ├── post-revprop-change.tmpl
│   ├── post-unlock.tmpl
│   ├── pre-commit.tmpl
│   ├── pre-lock.tmpl
│   ├── pre-revprop-change.tmpl
│   ├── pre-unlock.tmpl
│   └── start-commit.tmpl
├── locks
│   ├── db.lock
│   └── db-logs.lock
└── README.txt

10 directories, 28 files
```

# 配置svn用户
### home/cky/svn/conf/svnserve.conf
```shell
[general]
#匿名用户不可读
anon-access = none
#权限用户可写
auth-access = write
#密码文件为passwd
password-db = passwd
#权限文件为authz
authz-db = authz
```
### home/cky/svn/conf/authz
```shell
# 编辑制定管理员组 即admin组的用户为tone admin组有rw（读写权限） 所有人有r（读权限）
# 这里组的名字 不一定叫admin 你的管理员组名 可以叫做任意的名字，另外比如admin组还有其他用户，可以这样制定 admin=tone，tone1,tone2 类似这样的写法
[groups]
admin= tone

[/]
@admin = rw
*=r
```

### home/cky/svn/conf/passwd
```shell
# 编制passwd 文件 设定用户密码 明文的
[users]
# harry = harryssecret
# sally = sallyssecret
tone=www
```

# 启动svn服务
```
sudo svnserve -d -r /home/cky/svn
```

# 查看日志
```shell
svn log -l10  查看最近10次日志
```

# 对比差异
```shell
svn diff -r版本号  对比当前工作目录与某一次的版本的文件差异
```

# 回退修改
```shell
svn revert file/path 回退对某一个文件／目录的修改
```

# 添加忽略文件
- svn中对当前文件夹添加属性,执行命令后,直接在文本输入界面里填写要忽略的文件就好,默认编辑器在`.bash_rc`里设置`export SVN_EDITOR=vim`
```shell
svn propedit svn:ignore .
```



## 检出一个副本 ##
```
svn co http://路径(目录或文件的全路径)　[本地目录全路径] --username 用户名--password 密码
svn co svn://路径(目录或文件的全路径)　[本地目录全路径] --username 用户名--password 密码
```
## 将副本的文件添加到版本控制(注意不是提交到服务器仓库) ##
```
svn　add　文件名
```
## 提交修改文件 ##

```
svn ci -m “添加测试用test.c“   test.php
svn ci -m “添加测试用全部c文件“  *.c
```
## 将服务器仓库中的文件删除操作 ##
```
svn delete test.c
svn ci -m“删除测试文件test.c”
```
## 查看本地副本中是否有异常的文件 ##
```
svn st   #查看当前目录下异常文件状态
?：不在svn的控制中；M：内容被修改；C：发生冲突；A：预定加入到版本库；K：被锁定
svn status -v [path] 
-v 是连子目录中异常都显示
```
## 查看某个文件的详细信息和变更日志 ##
```
svn info test.php
svn log  test.php
```
## 将修改的文件与基础版本比较差异 ##
```
svn diff test.php
```
## 比较两个版本之间文本的差异 ##
```
svn diff -r200:201 test.php
```
## 加锁/解锁 ##
```
svn lock -m “lock test file“ [--force] test.php
svn unlock test.php
```
## 更新到1920版本 ##
```
svn update -r1920 test.php
```
## 更新当前目录和其子目录下文件 ##

```
svn up
```
## 将两个版本之间的差异合并到当前文件 ##
```
svn merge -r m:n path
例如：svn merge -r 200:205 test.php
（将版本200与205之间的差异合并到当前文件，但是一般都会产生冲突，需要处理一下）
```
## 恢复本地修改 ##
```
svn revert path : 恢复原始未改变的工作副本文件 (恢复大部份的本地修改)。
注意: 本子命令不会存取网络，并且会解除冲突的状况。但是它不会恢复被删除的目录
```
## 解决冲突 ##
```
svn resolved  path: 移除工作副本的目录或文件的“冲突”状态。
注意: 本子命令不会依语法来解决冲突或是移除冲突标记；它只是移除冲突的相关文件，然后让 PATH 可以再次提交。
```


svn 分为server 和 client , client 从server copy 副本，commit 修改，update 更新，并且形成日志！
svn 监听3690端口
svn 可以是单独svnserver（svn://协议访问） ,也可以是 apache 插件 (http://访问)
## 安装SVN  ##
```
sudo apt-get install subversion subversion-tools
```
## 配置svn ##
```
$mkdir  /var/svn/project_name
$svnadmin /var/svn/project_name
```
上面两步就配好了 svn 仓库，在/project_name/conf/下有
authz  passwd  svnserve.conf  三个文件

 - svnserve.conf 文件
```
       anon-access：   #控制非鉴权用户访问版本库的权限
       auth-access：write   #控制鉴权用户访问版本库的权限。
       password-db：passwd   #填用户密码文件
       authz-db：authz      #填用户权限文件
       realm：/var/svn/project_name   #填版本库目录
```
 - Passwd 文件
```
[users]
username = password
caokaiyan = caokaiyan
```
 - authz 文件
```
[groups]
dev = root,caokaiyan,shijie
test = yanfei
[/]
* = r      #所有用户对于全部文件夹都有写的权利
root = rw  #root 用户拥有全部文件夹的读写权利

[/develop]
@dev = rw  #只有dev组的用户拥有对 project_name/develop 文件夹的读写权利
@test = r

[/test]
@test = rw  #只有test组的用户拥有对 project_name/test 文件夹的读写权利
@dev = r
```
## 开启和关闭 svn 服务 ##
```
svnserve -d -r /var/svn/project_name  开启svn 服务
ps -aux |grep svn
kill -9  svn进程id  关闭是查找 svn 进程id,用 kill -9  杀掉
```
server端存的仓库数据都是经过压缩的，不能直接用！
我们必须先在服务器上 co 出一个 client 副本，作为 web 访问的目录,这个副本要能设置成自动更新！
```
svn  co  svn://127.0.0.1  /var/www/project_name
```
##SVN 副本自动更新 ##
svn 项目中的 hooks 文件中的 post-commit(该文件夹下有 tmp文件 去除后缀即可)，这是svn 给我们提供的钩子文件。
编辑它：（假设我们要自动更新的是web目录）
```
cd /var/www/web
svn cleanup
svn up --username=caokaiyan --password = caokaiyan --no-auth-cache --non-interactive /var/www/web
```
