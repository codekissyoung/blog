#标准文档流

##块元素

* 每个块级元素都从新的一行开始,左右自动伸展，直到包含它的元素，
,元素宽度在不设置的情况下，是它本身父容器的100%，除非设定一个宽度。

* 块状元素的高度、宽度、行高以及顶和底边距都可设置

##行内元素(内联元素)

* 本身没有宽度 , 它的宽度就是它包含的文字或图片的宽度，不可改变

* 和其他行内元素都在一行上

* 元素的高度、宽度及顶部和底部边距不可设置



##内联块状元素

`display:inline-block`

* 和其他元素都在一行上

* 元素的高度、宽度、行高以及顶和底边距都可设置

`<img>、<input>` 就是内联块状元素


## 标签嵌套

* 内联元素却不能包含块元素，它只能包含其它的内联元素：

`<div><h1></h1><p></p></div>` —— 对

`<a href=”#”><span></span></a>` —— 对

`<span><div></div></span>` —— 错

* `h1、h2、h3、h4、h5、h6、p、dt`只能包含内嵌元素，不能再包含块级元素

`<p><ol><li></li></ol></p>` —— 错

`<p><div></div></p>` —— 错

* 块级元素与块级元素并列、内嵌元素与内嵌元素并列：

`<div><h2></h2><p></p></div>` —— 对

`<div><a href="#"></a><span></span></div>` —— 对

`<div><h2></h2><span></span></div>` —— 错


##如果嵌套DIV,里面的比外面的大怎么解决?

* 外部div应该不设定width和height,而是靠内部div大小撑开

* 若不得已，应该用`overflow:hidden`将内部div超出外部的部分隐藏掉

* 若想它可以滚动显示,可以改为`overflow:scroll`


#盒模型
* 从上往下 可见内容为

border

content

padding

background-image

background-color

margin

## margin

margin控制的是盒子与盒子之间的距离，因此要精确控制盒子的位置，就必须对margin有更深入的了解


* 行内元素之间的水平margin当两个行内元素紧邻时，它们之间的距离为第一个元素的右margin加上第二元素的左margin。

* 两个竖直排列的块级元素的距离,是两者中的margin较大者。

* 嵌套盒子,子块的margin以父块的content为参考进行排列

* margin设为负值会使设为负数的块向相反的方向移动，甚至会覆盖在另外的块上。


#样式的继承

有些属性对一个标签声明后，它会被该标签的所有后代元素继承。

所有元素可继承：visibility,cursor

内联元素可继承：letter-spacing、word-spacing、white-space、line-height、color、font、 font-family、font-size、font-style、font-variant、font-weight、text-decoration、text-transform、direction。

块状元素可继承：text-indent和text-align

列表元素可继承：list-style、list-style-type、list-style-position、list-style-image

表格元素可继承：border-collapse

不可继承的：display、margin、border、padding、background、height、min-height、
max- height、width、min-width、max-width、overflow、position、left、right、
top、 bottom、z-index、float、clear、table-layout、vertical-align、page-break-after
page-bread-before和unicode-bidi


#样式的权值

标签的权值为1，类选择符的权值为10，ID选择符的权值最高为100

权值决定哪条css起作用
```
p{color:red;} /*权值为1*/
p span{color:green;} /*权值为1+1=2*/
.warning{color:white;} /*权值为10*/
p span.warning{color:purple;} /*权值为1+1+10=12*/
#footer .note p{color:yellow;} /*权值为100+10+1=111*/
p{color:red!important;} /* !important 权值最大*/
```

#css布局模型

##流动模型（Flow）

先来说一说流动模型，流动（Flow）是默认的网页布局模式。也就是说网页在默认状态下的 HTML 网页元素都是根据流动模型来分布网页内容的。

流动布局模型具有2个比较典型的特征：

第一点，块状元素都会在所处的包含元素内自上而下按顺序垂直延伸分布，因为在默认状态下，块状元素的宽度都为100%。实际上，块状元素都会以行的形式占据位置。如右侧代码编辑器中三个块状元素标签(div，h1，p)宽度显示为100%。

第二点，在流动模型下，内联元素都会在所处的包含元素内从左到右水平分布显示。（内联元素可不像块状元素这么霸道独占一行）



##浮动模型 (Float)

块状元素这么霸道都是独占一行，如果现在我们想让两个块状元素并排显示，怎么办呢？不要着急，设置元素浮动就可以实现这一愿望。

任何元素在默认情况下是不能浮动的，但可以用 CSS 定义为浮动，如 div、p、table、img 等元素都可以被定义为浮动。


##层模型（Layer）

什么是层布局模型？层布局模型就像是图像软件PhotoShop中非常流行的图层编辑功能一样，每个图层能够精确定位操作，但在网页设计领域，由于网页大小的活动性，层布局没能受到热捧。但是在网页上局部使用层布局还是有其方便之处的。下面我们来学习一下html中的层布局。

如何让html元素在网页中精确定位，就像图像软件PhotoShop中的图层一样可以对每个图层能够精确定位操作。CSS定义了一组定位（positioning）属性来支持层布局模型。

层模型有三种形式：

###1、绝对定位(position: absolute)

如果想为元素设置层模型中的绝对定位，需要设置position:absolute(表示绝对定位)，这条语句的作用将元素从文档流中拖出来，然后使用left、right、top、bottom属性相对于其最接近的一个具有定位属性的父包含块进行绝对定位。如果不存在这样的包含块，则相对于body元素，即相对于浏览器窗口。

###2、相对定位(position: relative)

如果想为元素设置层模型中的相对定位，需要设置position:relative（表示相对定位），它通过left、right、top、bottom属性确定元素在正常文档流中的偏移位置。相对定位完成的过程是首先按static(float)方式生成一个元素(并且元素像层一样浮动了起来)，然后相对于以前的位置移动，移动的方向和幅度由left、right、top、bottom属性确定。

偏移前的位置保留不动：就是说元素原来的位置，大小在正常文档流里。

###3、固定定位(position: fixed)

fixed：表示固定定位，与absolute定位类型类似，但它的相对移动的坐标是视图（屏幕内的网页窗口）本身。由于视图本身是固定的，它不会随浏览器窗口的滚动条滚动而变化，除非你在屏幕中移动浏览器窗口的屏幕位置，或改变浏览器窗口的显示大小，因此固定定位的元素会始终位于浏览器窗口内视图的某个位置，不会受文档流动影响，这与background-attachment:fixed;属性功能相同。以下代码可以实现相对于浏览器视图向右移动100px，向下移动50px。并且拖动滚动条时位置固定不变。


### absolute和relative配合使用

父元素设置为relative,可偏移，也可不偏移。

子元素设置为absolute,相对于上述父元素定位。





