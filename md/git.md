# 参考
[阮一峰的网络日志 / 常用 Git 命令清单](http://www.ruanyifeng.com/blog/2015/12/git-cheat-sheet.html)

[阮一峰的网络日志 / Git 使用规范流程](http://www.ruanyifeng.com/blog/2015/08/git-use-process.html)

[阮一峰的网络日志 / Git远程操作详解](http://www.ruanyifeng.com/blog/2014/06/git_remote.html)

[阮一峰的网络日志 / Git 工作流程](http://www.ruanyifeng.com/blog/2015/12/git-workflow.html)

![阮一峰的网络日志 / git示意图](http://www.ruanyifeng.com/blogimg/asset/2015/bg2015120901.png)

> 名词解释
- **Workspace**：工作区
- **Index / Stage**：暂存区域是一个文件，保存了下次将提交的文件列表信息，一般在 Git 仓库目录中。 有时候也被称作　索引　，不过一般说法还是叫暂存区域。
- **Repository**：仓库区（或本地仓库）
- **Remote**：远程仓库,可能会有好多个,有些可以写,有些你只能读。对于远程库的工作包括:推送或拉取数据,分享各自的工作进展,包括添加远程库,移除废弃的远程库,管理各式远程库分支,定义是否跟踪这些分支

# git 配置
- `git config --global user.name "John Doe"`　写的文件：`~/.gitconfig` 或 `~/.config/git/config`
- `git config user.name "codekissyoung"` 写的文件`项目目录/.git/config`
- `git config --global core.editor vim` 设置默认编辑器
- `git config --list` 列出当前库所有配置选项，配置变量会重复，值取最后获取到的
```
➜  ~ cat ~/.gitconfig
[user]
	email = cky951010@163.com
	name = caokaiyan
[push]
	default = simple
[alias]
	lg = log --color --graph --pretty=format:'%Cred%h%Creset -%C(yellow)%d%Creset %s %Cgreen(%cr) %C(bold blue)<%an>%Creset' --abbrev-commit
[core]
	quotepath = false
```

# 新建代码库
```
# 在当前目录新建一个Git代码库
$ git init

# 新建一个目录，将其初始化为Git代码库
$ git init [project-name]

# 下载一个项目和它的整个代码历史
$ git clone [url]
```

`在github上新建一个仓库git_test`
* 本地有仓库`test_git`
`git remote add git_test git://github.com/codekissyoung/git_test.git` 为本地仓库添加远程仓库,名字为git_test
`git remote -v`列出每一个远程仓库和它们的地址
`git fetch git_test` 将git_test仓库拉取到本地
`git fetch <远程主机名> <分支名>` 获取某个主机下的某个分支
`git branch -a` 显示所有的分支,包括远程的
`git checkout <远程分支名>` 切换到远程分支
`git remote show git_test` 查看远程仓库的详细信息
`git remote rm git_test` 删除远程仓库
`git remote rename <原主机名> <新主机名>` 改名

* 本地没仓库,而是直接clone的github上的仓库
`git clone git_url [文件夹名]` 克隆一个github上项目

直接克隆远程仓库,形成自己的本地仓库后,远程仓库的命名为`origin`,这是默认命名的
`git clone -o jQuery https://github.com/jquery/jquery.git`也可以在clone时自己设置名字(不推荐)
`git fetch` 默认是只获取origin主机上master分支？
`git checkout -b newBrach origin/master` 在origin/master的基础上，创建一个新分支
`git merge origin/master` 或 `git rebase origin/master` 在当前分支上，合并origin/master

## pull
`git pull <远程主机名> <远程分支名>:<本地分支名>` 取回远程主机某个分支的更新，再与本地的指定分支合并
`git pull origin next` 取回origin/next分支，再与当前分支合并
`git pull` 相当与 `git fetch origin next` + `git merge orgin/next`

## 追踪关系
`git branch --set-upstream master origin/next` 指定master分支追踪origin/next分支
`git pull origin` 当前分支与远程分支存在追踪关系，git pull就可以省略远程分支名
`git pull`如果当前分支只有一个追踪分支，连远程主机名都可以省略

#git rebase
http://blog.csdn.net/hudashi/article/details/7664631

# 将一台服务器作为远程仓库(类似github)
http://blog.csdn.net/wangjia55/article/details/8802490
实现的效果是,我们可以通过`git clone ssh://software@172.16.0.30/~/yafeng/.git`拿到那台服务器上的代码,那台服务器可以代替github使用了

# 一个牛逼的git分支模型的使用
http://www.oschina.net/translate/a-successful-git-branching-model
查看附件,有模型的图

# git 获取远程分支
通过`Git clone` 获取的远端git库，只包含了远端git库的当前工作分支。
如果想获取其它分支信息，需要使用`git branch –r`来查看， 如果需要将远程的其它分支代码也获取过来，可以使用命令：

```
git checkout -b 本地分支名 远程分支名
```
其中，远程分支名为`git branch –r`所列出的分支名， 一般是诸如`origin/分支名`的样子
如果本地分支名已经存在， 则不需要`-b`参数

# 中文支持
在日志里正确显示中文 shell 里执行
```
export LESSCHARSET=utf-8
```
中文名称正确显示(utf-8下) shell 里执行
```
git config --global core.quotepath false
```
