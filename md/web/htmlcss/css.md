# @import 指令
- 引入别的css脚本
```css
@import url('base-text.css');
@import url('only-screen.css');
```

# 高效的css选择器
1. `div #myid` 错误 ，改为 `#myid`,解释：id选择器为唯一的,前面加上标签反而累赘

2. 使用class代替层级关系

# css选择器

```css

.class {} 类选择器

#id {} id 选择器

h1 {}  标签选择器

h3.class{} 交集选择器,h3 和.class之间没有空格

h3,class{} 并集选择器

.class h3{} 后代选择器，class 标签里面所有的 h3 标签

.class>h3{} 子选择器，class 标签里面所有 子级 h3 标签

h1[src]{} /*匹配所有拥有class属性的h1标签*/

a[href][title]{} /*匹配同时拥有href和title属性的a标签*/

a[href="http://www.baidu.com"]{} /*属性值匹配*/

a[href="http://www.baidu.com"][title="baidu"]{} /*同时满足...*/

a[class^=icon]{} /*查询class以icon开头的a元素*/

a[href$=pdf]{} /*查询href以pdf结尾的a元素*/

a[title*=more]{} /*查询title中包含more字段的元素*/

div:not([id="footer"]){} /* 除了div的id为footer的选择器 */

div:empty {} /* 选择的是里面没有内容的div元素 */

ol > li:first-child{} /* 先选中ol下所有li子元素,再取第一个 */
ol > li:last-child{} /* 匹配到的列表中最后一个元素 */
ol > li:nth-child(3) /* 匹配第3个li */
ol > li:nth-child(2n+1) /* 匹配奇数项　*/
ol > li:nth-child(2n) /* 匹配偶数项 */
ol > li:nth-last-child(n) /* 与 nth-child 一样，不同的是从最后一个元素开始计算 */


input[type="text"]:enabled {} /*可用性选择器*/
input[type="text"]:disabled {} /*不可用性选择器*/
input[type="checkbox"]:checked {} /*被选中状态的单选或复选框*/
input[type="text"]:read-only{} /* 只读属性选择器　*/
input[type='text']:read-write{} /* 可读写属性选择器　*/
```

# ::before 和 ::after 在元素内部的前后插入内容
- 清除浮动
```css
.clearfix::before,.clearfix::after {
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}
.clearfix:after {clear: both;}
.clearfix {zoom: 1;}
```

# 鼠标选中的文本的状态
```css
::selection {}
```


# 选择器的权值
- 当两个选择器匹配到了同一个元素，并且为这个元素设置了同一个属性如border，浏览器会使用权值高的那个选择器
```css

p{color:red;} /*权值为1*/

p span{color:green;} /*权值为1+1=2*/

.warning{color:white;} /*权值为10*/

p span.warning{color:purple;} /*权值为1+1+10=12*/

#footer .note p{color:yellow;} /*权值为100+10+1=111*/
```

# 层叠特性
- 在同一权值下，后声明的属性会覆盖已经声明的同一属性

# 继承
- 子元素继承父元素css属性的特性
- 可继承的css 元素如下
```css
color:#eee
font:
font-style
font-variant:
font-weight:bold
font-size
font-family:
font-stretch:
font-size-adjust:
visibility: visible | hidden | collapse  /* 主要用来隐藏表格的行或列。隐藏的行或列能够被其他内容使用。对于表格外的其他对象，其作用等同于hidden。*/

list-style
list-style-image
list-style-position
list-style-type

table-layout
border-collapse
border-spacing
caption-side
empty-cells

text-decoration-skip 检索或设置对象中的文本装饰线条必须略过内容中的哪些部分
text-underline-position 检索或设置对象中的下划线的位置。
text-shadow         设置或检索对象中文本的文字是否有阴影及模糊效果

text-transform 检索或设置对象中的文本的大小写
white-space 设置或检索对象内空格的处理方式
tab-size        检索或设置对象中的制表符的长度
word-wrap 设置或检索当内容超过指定容器的边界时是否断行
overflow-wrap 设置或检索当内容超过指定容器的边界时是否断行
word-break 设置或检索对象内文本的字内换行行为
text-align        设置或检索对象中内容的水平对齐方式
text-align-last 设置或检索一个块内的最后一行 包括块内仅有一行文本的情况，这时既是第一行也是最后一行,或者被强制打断的行的对齐方式
text-justify 设置或检索对象内调整文本使用的对齐方式
word-spacing 检索或设置对象中的单词之间的最小，最大和最佳间隙
letter-spacing 检索或设置对象中的字符之间的最小，最大和最佳间隙
text-indent 检索或设置对象中的文本的缩进
vertical-align 设置或检索对象内容的垂直对其方式
line-height 检索或设置对象的行高。即字体最底端与字体内部顶端之间的距离
text-size-adjust 检索或设置移动端页面中对象文本的大小调整

cursor:
zoom:
direction:ltr|rtl
```

# 注释风格
```css
/*　首页样式
--------------------------------------------------------------------------------------------------- */
```
