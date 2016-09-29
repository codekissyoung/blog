# git 配置文件
`/etc/gitconfig` 文件：系统中对所有用户都普遍适用的配置。`git config --system` 读写的就是这个文件。

`~/.gitconfig `文件：用户目录下的配置文件只适用于该用户。`git config --global` 读写的就是这个文件。

工作目录中`.git/config `文件：这里的配置仅仅针对当前项目有效。

每一个级别的配置都会覆盖上层的相同配置

`git  config   --global   user.name     "your name "`

`git  config   --global    user.email   "email@example.com"`


# git本地操作

在仓库目录执行 `git init`创建一个新仓库

`git add <file>` 将新建/改动后的文件 从工作区移动到暂存区

`git rm --cached <文件>` 撤出暂存区

`git checkout <file>` 从版本库取出这个文件的最新版本 ，替换掉改动了的文件

`git commit -m"提交说明"` 将暂存区里的所有文件提交到版本库,形成一个版本

`git status` 查看当前  git  仓库状态

`git  diff file_dir` 查看当前仓库某个文件与前一个版本的差异

`git  log` 提交日志的查看，就看每次 commit 的备注,以及其版本号(一个散列字符串,一个字符串为一个版本)

`git reset --hard 版本号` 切换版本

`git  reflog`记录每一次commit/reset命令的日志,可以通过它找回版本号


# 分支功能

`git branch <name>` 创建分支

`git branch` 查看分支

`git checkout <name>` 切换分支

`git branch ‐d <name>`删除分支

`git merge --no-ff -m "合并dev分支" <name>` 用普通模式合并,合并后的历史有分支,能看出来曾经做过合并,而 fast forward 合并就看不出来曾经做过合并。

`git merge <name>` 合并name分支到当前分支

`git log --graph --pretty=oneline --abbrev-commit` 用带参数的 git log 也可以看到分支的合并情况


# 标签功能

tag就是在某次commit上打一个标记而已，方便你记忆识别这个commit,以及回退到这一次commit的版本中来

`git tag -a v1.01 -m "Relase version 1.01"` 当前分支的最近一个commit打一个v1.01标签

`git tag -a v0.1.1 9fbc3d0` 给指定的commit加tag

`git tag -d v1.01`删除标签

`git tag` 当前分支下标签列表

`git checkout <tag>` 切换到某一个标签

`git show v0.1.2` 查看标签的详细信息

`git push origin v0.1.2`将v0.1.2标签提交到git服务器

`git push origin –tags`将本地所有标签一次性提交到git服务器


# 修复bug流程

当你接到一个修复一个代号101的bug的任务时,很自然地,你想创建一个分支`issue‐101`来修复它,但是,等等,当前正在`dev` 上进行的工作还没有提交,并不是你不想提交,而是工作只进行到一半,还没法提交,预计完成还需1天时间。但是,必须在两个小时内修复该bug,怎么办?

1. `git stash` 在dev上执行,把当前分支的工作现场保存起来

1. `git status` 查看工作区,就是干净的( 除非存在没有被Git管理的文件 )

1. `git checkout master` 切换到master分支(假设bug在`master`分支上)

1. `git pull` 先获取最新代码到本地

1. `git checkout -b issue-101` 新建一个解决bug的分支

1. `git add --all` 在 issue-101 分支下修改完bug：

1. `git commit -m"修复好issue-101bug"` 提交

1. `git checkout master`  切换回master

1. `git merge --no-ff -m "merged bug fix 101" issue-101` 合并issue-101分支到master分支

1. `git branch -d issue-101` 合并完后删除issue-101分支

1. `git checkout dev` 切换回dev分支上继续干活儿

1. `git stash list` 查看在dev上保存的工作现场

1. `git stash apply` 恢复现场,恢复后,stash内容并不删除,你需要用`git stash drop `来删除

1. `git stash pop` 恢复现场,恢复的同时把stash内容也删了


# github 项目

`ssh-keygen -t rsa`生成密钥对,将ssh公钥(.ssh/id_rsa.pub里面)放到github服务器

`github.com->settings->Personal access tokens`生成一个用于访问GitHub API的秘钥,记下它
