# 编辑模式 vs 命令模式
`Esc` 进入命令模式
`o` `i` 进入编辑模式

# 编辑模式
编辑模式就是正常输入字符 没什么特别的

# 命令模式
以下操作都是命令模式

# 使用标签页 操作多个文件
`set tabpagemax=15` 设置最大打开的标签页数

`:tabe file_path` 在标签页打开文件

`:tabn` 移动到下一个标签页

`:tabp` 移动到上一个标签页

`:w` 保存文件

`:wq` 保存文件 并退出标签页

# 剪切 拷贝 粘贴
`ngg` 移动到这个文件的第 n 行

`hjkl` 移动光标

`ndd` 光标处向下剪切 n 行

`nyy` 光标处向下复制 n 行

`:100,200y`  拷贝100到200行

`:100,200d`  剪切100到200行

`p` 粘贴

`u`       撤销上一个操作

`Ctrl + r` 对`u`操作的撤回

`.` 重复前一个命令的动作

# 查找文本
`/word`   在光标处向下查找word

`？word`  在光标处向上查找word

# 分屏
`:split` 一个文件上下两屏

`ctrl + ww` 在多屏中依次跳转

# `.vimrc`常用配置命令
可写在`.vimrc`中，启动vim就执行

`.vimrc` 参考
```
set nu   "设置行号"
set fdm=marker "设置代码折叠"
set autoindent "设置自动缩进"
set tabstop=4  "设置tab为4个空格"
set list "vim显示空格和tab"
set listchars=tab:>-,trail:- "vim显示空格和tab"
if has("syntax")
  syntax on "语法高亮"
endif
```
直接在vim里执行
`:set nonu`  取消行号


# 代码折叠设置
`:set fdm=indent` 自动折叠一些代码

`:set fdm=marker` 设定标记折叠

`zf56G`创建从当前行起到56行的代码折叠

`zf%`  创建从当前行起到对应的匹配的括号上去`()，{}，[]，<>`等的折叠

`zc`   折叠

`zm`   关闭所有折叠

`zR`   打开所有

将光标置于折叠标记处
`zd `  删除在光标下的折叠

`zD `  嵌套删除在光标下的折叠



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

# 可视模式
`v`  字符选择，将光标经过的地方反白显示

`V`  行选择，会将光标经过的行反白选择

`ctrl + v` 块选择，可以用竖直的长方形的方式选择数据

`y`  复制反白的地方

`d`  将反白的地方删除掉

`p`  将复制的内容粘贴
