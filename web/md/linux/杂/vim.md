# 可以借鉴和参考的文章
- [图解VIM常用操作](http://blog.csdn.net/marksinoberg/article/details/77595574)

# 编辑模式 vs 命令模式
- `Esc` 进入`命令模式`: 可以使用快捷键命令　和　冒号命令
- `o` `i` 进入`编辑模式`: 就是正常输入字符

# vimrc
```
~/.vimrc 代表的是/root/.vimrc 修改这个路径下的.vimrc文件仅仅会对root用户有效。
/etc/vim/.vimrc 路径下的.vimrc被修改的话，则会对登录到Linux上的所有用户有效。
```


# 可视模式 - 剪切 拷贝 粘贴
```
v   字符选择，将光标经过的地方反白显示
V  行选择，会将光标经过的行反白选择
ctrl + v 块选择，可以用竖直的长方形的方式选择数据
y  复制反白的地方
d  将反白的地方删除掉
p  将复制的内容粘贴
```

# 移动光标
```
Shift + 6 : 即 ^ 到行首去
Shift + 4 : 即 $  到行尾去
gg        : 到文首
Shift + g : 到文尾
```



# 标签页-操作多个文件
```
set tabpagemax=15   .vimrc设置最大打开的标签页数
:tabe file_path     在标签页打开文件
:tabn   移动到下一个标签页
:tabp   移动到上一个标签页
:w 保存文件
:wa 保存vim打开的所有文件
:wq 保存文件 并退出标签页
:wqa 保存vim打开的所有文件 并退出vim
```

# 剪切 拷贝 粘贴
```
ngg  移动到这个文件的第 n 行
hjkl 移动光标
ndd  光标处向下剪切 n 行
nyy  光标处向下复制 n 行
:100,200y  拷贝100到200行
:100,200d  剪切100到200行
p  粘贴拷贝或者剪切的行
u  撤销上一个操作
Ctrl + r 对u操作的撤回
. 重复前一个命令的动作
```

# 分屏操作同一文件
```
:sp  上下分屏
:vsp 左右分屏
ctrl + ww : 在多屏中依次跳转
ctrl + w + 方向键 : 在多屏中依次跳转
```

# 代码折叠设置
```
:set fdm=indent 自动折叠一些代码
:set fdm=marker 设定标记折叠
zf56G 创建从当前行起到56行的代码折叠
zf%   将光标放置在()，{}，[]，<>上，创建从当前行起到对应的匹配的()，{}，[]，<>等的折叠
zc    折叠当前所在标记
zm    关闭所有折叠
zR    打开所有
zd    将光标置于折叠标记处,删除在光标处对应的的当前折叠
zD    将光标置于折叠标记处,嵌套删除在光标下的折叠
```

# 查找文本
```
/word   在光标处向下查找word
？word  在光标处向上查找word
```

```
set hlsearch  " 高亮查找项
set incsearch " 查找跟随
set ignorecase " 查找时忽略大小写
```

# vim中执行命令
```
:! [shell命令]
```

# 定义快捷键
```
noremap <F6> :set nu
noremap <F7> :set ai
noremap <F8> :set syntax on
```

# 文本替换操作
总格式为 `:[选定范围]s分割符[正则表达式]分割符[替换文本]分割符[g]`

[选定范围]`2,5` 表示2到5行,`.,10`表示当前行到第10行,`^,10`表示开头到第10行,`10,$`表示第10行到末尾,`%`表示每一行
[分割符] 可以为 `/` `+` `#`

[正则表达式]

[g] 不带`g`表示只替换匹配到的第一个

`:s/vivian/sky/` 替换当前行第一个vivian 为 sky

`:s/vivian/sky/g` 替换当前行所有vivian 为 sky

`:%s/vivian/sky/` 替换每一行的第一个 vivian 为 sky

`:%s/vivian/sky/g` 替换每一行中所有 vivian 为 sky

`:2,$s/vivian/sky/g` 替换第 2 行开始到最后一行中每一行所有 vivian 为 skyn 为数字

`:.,$s/vivian/sky/g` 替换当前行开始到最后一行中每一行所有 vivian 为 skyn 为数字

`:s#vivian/#sky/#` 替换当前行第一个 `vivian/` 为 `sky/` ,可以使用`#`作为分隔符，此时中间出现的`/` 不会作为分隔
符

`:%s+/oradata/apras/+/user01/apras1/+` 替换 `/oradata/apras/`成`/user01/apras1/`,使用`+`作为分割符

在所有行的行首添加字符`:%s/^/your_word/`

在所有行的行尾添加字符 `:%s/$/your_word/`

删除空行 `:g/^\s*$/d` 删除包括空白，Tab，空白和Tab交错的所有空行


# vim正则表达式
使用范围
`/正则表达式`

`:%s/正则表达式/替换内容/g`

`:%s/^\t\+$/\r/g` 将只有[tab]开头的行换成空行

`:%s/^\s\+$/\r/g` 将只有空白的行换成空行

# 删除文本文件中的^M
对于换行,window下用回车换行`(0A0D)`来表示，Linux下是回车`(0A)`来表示。这样，将window上的文件拷到Unix上用时，总会有个`^M`.请写个用在unix下的过滤windows文件的换行符`(0D)`的`shell`或`c`程序。
使用命令：`cat filename1 | tr -d "^V^M" > newfile`
使用命令：`sed -e "s/^V^M//" filename > outputfilename` 需要注意的是在1、2两种方法中，`^V`和`^M` 指的是`Ctrl+V`和`Ctrl+M`。你必须要手工进行输入，而不是粘贴。
在vi中处理：首先使用vi打开文件，然后按ESC键，接着输入命令`%s/^V^M//`和`:%s/^M$//g`
如果上述方法无用，则正确的解决办法是：
`tr -d "\r" < src >dest`
`tr -d "\015" dest`
`strings A>B`


# `.vimrc` 参考
- `.vimrc`相当于打开vim的时候，执行了一系列vim命令如，`:set nu`设置行号  

```vim
set nu   "设置行号
set fdm=marker "设置代码折叠
set autoindent "设置自动缩进
set tabstop=4  "设置tab为4个空格
set list "vim显示空格和tab"
set listchars=tab:>-,trail:- "vim显示空格和tab
if has("syntax")
  syntax on "语法高亮
endif
```

# vim 插件管理
- [Vundle](https://github.com/VundleVim/Vundle.vim) 插件管理工具
- [nerdtree](https://github.com/scrooloose/nerdtree) 目录树工具
