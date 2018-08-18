# Ubuntu18装机指南

## 下载安装
- 下载`Ubuntu 18.04 .iso`镜像
- 下载U盘装机软件`LinuxLive USB Creator`
- 设置电脑的启动盘顺序，U盘进入，安装

## 查看系统版本和环境
```bash
lsb_release -a
cat /etc/issue
uname -a
```

## 软件安装原则
- 优先选择该系统版本上的默认软件,比如`ubuntu 16.04`的默认PHP版本是7.0,那就不要去用7.1的版本,否则会带来很大的麻烦

## 下载必备软件
- 软件市场，或者网络下载 `Chrome`，`Chromium`， `Vistual Studio Code`

```bash
sudo apt-get update                      更新软件源
sudo apt-get upgrade　                   从软件源处更新软件
sudo apt-get autoremove                  自动卸载系统不需要的软件
sudo apt-get install vim　               安装vim编辑器
sudo update-alternatives --config editor 默认编辑设置为vim
sudo apt-get install git                 安装git
sudo apt-get install unrar               安装rar解压工具
sudo apt-get install zsh                 安装zsh 配置oh-my-zsh

sudo apt-get install tmux                用于保持工作现场 [服务器端]
sudo apt-get install lnav                安装终端看访问日志的神器 lnav观看 [服务器端]
sudo apt-get install openssh-server      安装ssh-server 可供远程登录 [服务器端]
```

## 接入GitHub
- 生成密钥 `ssh-keyen`, 将密钥`~/.ssh/id_rsa.pub`上传到Github > Settings > SSH And GPG keys

## 连接到远程开发服务器
- 将密钥`~/.ssh/id_rsa.pub`加入到远程服务器的`~/.ssh/authorized_keys`中
- `scp .ssh/id_rsa.pub cky@codekissyoung.com:~/id_rsa.pub`
- `cat id_rsa.pub >> .ssh/authorized_keys`
- 登陆远程服务器 `ssh cky@codekissyoung.com`

## 搭建C/C++开发环境
- 安装build-essential这个软件包，安装了这个包会自动安装上g++,libc6-dev,linux-libc-dev,libstdc++6-4.1-dev等一些必须的软件和头文件的库。

```
sudo apt-get install build-essential
gcc -v
gdb -v
make -v
```

## 安装QT
```bash
http://download.qt.io/official_releases/qt/5.9/5.9.5/
```
