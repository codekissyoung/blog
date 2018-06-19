# Markdown 博客

> 一个管理的markdown的博客,所有的博客都是markdown文件

## 初始化

```git
git submodule init
git submodule update
```

## 暂时未解决问题

### 代码高亮闪屏

- 问题描述: html先加载完毕，这个时候代码高亮是未渲染的,然后代码高亮js执行,将无高亮的代码块变成高亮的，用户能明显感觉出代码的高亮变化过程。
- 解决方案: 将代码高亮部分放到服务端去做？