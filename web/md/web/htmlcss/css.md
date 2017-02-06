# @import 指令
- 引入别的css脚本
```css
@import url('base-text.css');
@import url('only-screen.css');
```

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

# 高效的css选择器
1. `div #myid` 错误 ，改为 `#myid`,解释：id选择器为唯一的,前面加上标签反而累赘
2. 使用class代替层级关系

# ::before 和 ::after 在元素内部的前后插入内容
- 清除浮动
```css
.clearfix:before,.clearfix:after {
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
color:#eee;
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
white-space    设置或检索对象内空格的处理方式
tab-size       检索或设置对象中的制表符的长度
word-wrap      设置或检索当内容超过指定容器的边界时是否断行
overflow-wrap  设置或检索当内容超过指定容器的边界时是否断行
word-break     设置或检索对象内文本的字内换行行为
text-align     设置或检索对象中内容的水平对齐方式
text-align-last 设置或检索一个块内的最后一行 包括块内仅有一行文本的情况，这时既是第一行也是最后一行,或者被强制打断的行的对齐方式
text-justify   设置或检索对象内调整文本使用的对齐方式
word-spacing   检索或设置对象中的单词之间的最小，最大和最佳间隙
letter-spacing 检索或设置对象中的字符之间的最小，最大和最佳间隙
text-indent    检索或设置对象中的文本的缩进
vertical-align 设置或检索对象内容的垂直对其方式
line-height    检索或设置对象的行高。即字体最底端与字体内部顶端之间的距离
text-size-adjust 检索或设置移动端页面中对象文本的大小调整

cursor:
zoom:
direction:ltr|rtl;

```

# 设计好css代码的结构
按顺序书写以下结构

主体样式
1. reset样式
1. 链接
1. 标题

辅助样式
1. 表单
1. 通知与错误
1. 一致的条目

页面结构
1. 标题,页脚,导航
1. 布局
1. 其他页面结构元素

页面组件
1. 各个页面

特殊覆盖样式

# 建立样式指南表
建立包含这个站点可能出现的每种排版和布局组合的页面


# 盒模型
1. 使用`outline:1px solid red;`轮廓绘制在元素框之上,不影响元素大小和定位，被用来debug
1. 只有普通文档流中`块元素`的垂直外边距才会发生外边距叠加。行内框，浮动框和绝对定位框之间的外边距不会叠加。
1. `inline`元素在一行上水平排列，只能设置行高，水平边框，水平padding，水平margin
1. `inline-block`也可以在一行上水平排列， 并且可以设置width,height,margin,padding等

# 相对定位
1. 相对是相对与在原文档流中的位置
1. 元素无论是否移动，元素仍然占据原来空间


# 绝对定位
1. 相对于距离最近的已定位的祖先元素
1. 脱离文档流，元素不占据原来空间
1. 绝对定位的元素可以覆盖页面上的其他元素,通过`z-index`控制叠放顺序

# 固定定位
1. 相当于绝对定位，相对于`视口`进行定位

# 浮动定位
1. 浮动框可以左右移动，直到外边缘碰到包含块或者另一个浮动框的边缘
1. 浮动后的元素也脱离文档流，不占空间
1. 可覆盖其他元素,`z-index`控制覆盖
1. 水平无法容纳水平浮动的所有元元素,则后面的元素继续向下浮动，并且可能会出现卡住现象。
1. `inline`行框会围绕在浮动框的外边。

使用父元素伪类清理浮动代码
```
.clear:after{
	content:'.';
	height:0;
	visibility:hidden;
	display:block;
	clear:both;
}
```



# a 链接
1. 只能用于GET请求，绝对不要用于POST请求

# 雪碧图
```
nav li a {
	background-image:url(/img/default.jpg);
	background-repeat:no-repeat;
}
nav li.home a{
	background-position:0 -100px;
}

```


## 隐性改变display类型
有一个有趣的现象就是当为元素（不论之前是什么类型元素，display:none 除外）设置以下 2 个句之一：
position : absolute
float : left 或 float:right
元素会自动变为以 display:inline-block 的方式显示，当然就可以设置元素的 width 和 height 了且默认宽度不占满父元素。
如下面的代码，小伙伴们都知道 a 标签是行内元素，所以设置它的 width 是 没有效果的，但是设置为 position:absolute 以后，就可以了。
