# [酷壳网](http://coolshell.cn)

# LFS
Linux From Scratch，简称 LFS，不同于其它的 Linux 发行版，它是一种给使用者指导建议，由使用者自行从头开始自己构建的发行版。LFS 发行版及其衍生版本，都由其同名的手册提供了完整的指导建议。
目标是安装一个与现有发行版毫无关系的系统，安装LFS仍然不能无中生有，而必须要有一个可以编译软件包的运行中的Linux系统。这个系统一般称为宿主系统。
官方网站：　http://www.linuxfromscratch.org/news.html　
目标：根据最新指导，编译一个可用的linux系统

# 鸟哥的linux私房菜
http://linux.vbird.org/linux_basic/

# 几篇使用CentOS的文章
https://seisman.info/categories/Linux/
http://xfphp.cn/2015/10/23/centos-nginx/

# linux 社区
https://linux.cn
https://www.netcraft.com/

linux 严格区分大小写
linux 所有内容(包括硬件设备)都以文件形式保存和管理
linux 没有拓展名概念 只有一些约定俗成的后缀名 主要方便管理员区分


# 单用户模型
操作系统不用确认用户身份，直接可以进行任何操作的一种模式

# 关于百度DNS的解析过程
http://zhan.renren.com/starshen?gid=3602888498023142484&checked=true

# Clang
得益于Apple的Clang。
注：Clang 是一个 C++ 编写、基于 LLVM、发布于 LLVM BSD 许可证下的 C/C++/Objective C/Objective C++ 编译器，
其目标（之一）就是超越 GCC。由于使用了Clang所以这个插件在离线安装模式下（因为开发机没有网络，或者Proxy不太好用）
就复杂一点，需要先安装最新版本的GCC才能编译Clang。

# 使用 systemd 中的定时器执行定时任务
[https://linux.cn/article-3996-1.html](https://linux.cn/article-3996-1.html)

# 如何在 systemd 下管理Linux系统的时间和日期
[https://linux.cn/article-4260-1.html](https://linux.cn/article-4260-1.html)

# 如何为CentOS 7配置静态IP地址
[https://linux.cn/article-3977-1.html](https://linux.cn/article-3977-1.html)

# 资源
[centos官方论坛]([https://www.centos.org/forums/index.php](https://www.centos.org/forums/index.php))
如何解决系统存在同一个库的多个版本的问题？
How to resolve multilib problem?
https://www.centos.org/forums/viewtopic.php?f=47&t=52898
`package-cleanup --dupes` 命令可以显示存在多个版本的包
`package-cleanup --cleandupes` 可以去除低版本的包


# php7
http://www.php7.site/

# php the right way (php之道)
http://laravel-china.github.io/php-the-right-way/

# php内核探索
http://www.nowamagic.net/librarys/veda/detail/1285

# github 上的一些资源！
http://www.php100.com/html/dujia/2015/0105/8267.html

# 一个优秀网站的登录验证流程
http://blog.csdn.net/clevercode/article/details/45481409

# php header 函数
http://www.laruence.com/2007/12/16/308.html

# 46 个非常有用的 PHP 代码片段
http://www.techug.com/useful-code

# php如何实现验证码
http://www.php100.com/html/dujia/2015/0919/8975.html

# PSR-1 基本代码书写规范 (Basic Coding Standard)
http://segmentfault.com/a/1190000002521577
https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md

# PSR-2 Coding Style Guide
https://segmentfault.com/a/1190000004649320
https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md

# PSR-3 Logger Interface
http://www.php-fig.org/psr/psr-3/

# PSR-4 规范(PSR-0废弃,使用PSR-4代替)
http://segmentfault.com/a/1190000002521658
http://segmentfault.com/a/1190000000380008 PSR-4 实现

# 深入理解Yii2.0
http://www.digpage.com

# Yii官方文档
http://www.yiiframework.com

# composer官网
https://getcomposer.org/

# composer中文网　(换composer源)
http://www.phpcomposer.com/

# PHPhub社区
https://phphub.org

# getYii社区
http://www.getyii.com

# 韩天峰博客
http://rango.swoole.com

# php 内核学习
http://www.php-internals.com

# php实现视频上传
http://www.jb51.net/article/54433.htm

# 产品工具
百度脑图 http://naotu.baidu.com/home

# 技术栈-前端
## 网页工具
http://codepen.io/  网站前端设计开发平台
http://tool.c7sky.com/　小影的工具箱，里面有配色的工具
http://www.58pic.com/peise/　千图网配色工具
http://css.doyoe.com/   css 手册
http://www.feedthebot.com/tools/gzip/　　检测web服务器的gzip压缩是否启用
http://www.feedthebot.com/tools/requests/　尽量减少DNS查询次数，使用下面这个工具检测
http://www.woshipm.com/  人人都是产品经理

##jquery
http://jquery.cuishifeng.cn/index.html 一个很棒的中文参考手册
http://api.jquery.com/　
http://www.jq-school.com/　　　　　
http://fancyapps.com/fancybox/
http://tool.oschina.net/  在线web 开发工具库
http://www.jq22.com/ 一个 jquery 插件库


## 模块化框架
http://seajs.org/docs/　　　sea.js
require.js
## mvc 框架
Angular.js
## 前端性能问题
http cache
local  cache (H5)
compress (压缩)
DOM  render 渲染
## 前端自动化
grunt
nodejs
glup
## 跨终端适配
http://mediaqueri.es  响应式设计创意收集网站
http://thinkvitamin.com/ 最好的响应式网站
http://validator.w3.org/  W3C的HTML5验证工具,上传html文件，选择编码和文档类型就可check了
http://designlovr.com/ examples/dynamic_stack_of_index_cards/。

js 跨域问题                   http://segmentfault.com/a/1190000000718840
ＭＤＮjavascript 板块         https://developer.mozilla.org/zh-CN/docs/Web/JavaScript

ajax 异步上传文件              http://www.open-open.com/lib/view/open1417248655206.html
                             http://www.2cto.com/kf/201411/349708.html
ECMAScript入门                http://es6.ruanyifeng.com/#docs/intro
ubuntu Node.js 开发环境    http://jingyan.baidu.com/article/046a7b3edebf38f9c27fa9bc.html
coffeeScript                 http://coffee-script.org/

#技术栈-后端
##数据分析和优化


#技术栈-服务器
#技术栈-存储



#技术栈-工具和架构
MarkDown语法    http://wowubuntu.com/markdown/index.html




代码托管
代码发布和迭代

#infoQ
InfoQ - 促进软件开发领域知识与创新的传播
http://www.infoq.com/cn

# freebuf 关注黑客与极客
http://www.freebuf.com/

#异步社区　一个电子书社区
http://www.epubit.com.cn/　

# ACM 刷题
https://leetcode.com/　
http://www.lintcode.com/zh-cn/　

# 技术博客
http://www.cnblogs.com/TomXu/　汤姆大叔 [js]
http://www.cnblogs.com/yexiaochai/ [前端]
https://yichunzhang.wordpress.com/2006/11/　
http://yansu.org/index.html  里面有些笔记，可以查阅的
http://rapheal.sinaapp.com  拉风的博客


# opengl 相关的
http://www.opengl-tutorial.org/
http://ogldev.atspace.co.uk/index.html　
https://www.dreamxstudio.com/!/#  石杰学长的 SVN 仓库，账号密码：caokaiyan
http://www.opengpu.org/  图形学论坛
http://www.chadvernon.com/blog/resources/managed-directx-2/loading-a-static-x-mesh/   入门
http://www.chadvernon.com/blog/resources/directx9/ 入门
https://github.com/gameKnife/Softrenderer   进阶
https://github.com/gameknife/gkEngine  进阶
