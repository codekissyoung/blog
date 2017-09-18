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

# 查看版本库里 日志 目录 内容
```shell
svn log -l10                        # 查看最近10次日志 用来展示svn 的版本作者、日期、路径等等
svn log;                            # 什么都不加会显示所有版本commit的日志信息
svn log -r 4:5                      # 只看版本4和版本5的日志信息
svn log test.c                      # 查看文件test.c的日志修改信息
svn log -v dir                      # 查看目录的日志修改信息,需要加v
svn cat -r 4 test.c                 # 查看版本4中的文件test.c的内容,不进行比较;
svn list http://svn.test.com/svn    # 查看目录中的文件;
svn list -v http://svn.test.com/svn # 查看详细的目录的信息(修订人,版本号,文件大小等)
```

# 对比差异
```shell
svn diff                # 什么都不加，会检测本地代码和缓存在本地.svn目录下的信息的不同，用来显示特定修改的行级详细信息
svn diff -r 3           # 比较你的本地代码和版本号为3的所有文件的不同
svn diff -r 3 text.c    # 比较你的本地代码和版本号为3的text.c文件的不同
svn diff -r 5:6         # 比较版本5和版本6之间所有文件的不同
svn diff -r 5:6 text.c  # 比较版本5和版本6之间的text.c文件的变化
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
