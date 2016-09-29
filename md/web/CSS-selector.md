[TOC]

#高效的css选择器

1，`div #myid` 错误 ，改为 `#myid`,解释：id选择器为唯一的,前面加上标签反而累赘

2，`span .className`错误，改为 `.className`，理由同上

3，减少层级关系

4，使用class代替层级关系



# 子选择器 `.food > li{border:1px solid red;}`

用于选择指定标签元素的第一代子元素

#后代选择器` .first[空格]span{color:red;}`

子选择器具　与　包含选择器不同 :  >作用于元素的第一代后代，空格作用于元素的所有后代。



#伪类选择器`a:hover{color:red;}`

兼容性不好，最常用的　a : hover



#分组选择器 `h1,span{color:red;}`

它相当于下面两行代码：h1{color:red;}span{color:red;}



#css选择器

```

.class {} 类选择器

#id {} id 选择器

h1 {}  标签选择器

h3.class{} 交集选择器,h3 和.class之间没有空格

h3,class{} 并集选择器

.class h3{} 后代选择器，class 标签里面所有的 h3 标签

.class>h3{} 子选择器，class 标签里面所有 子级 h3 标签

h1[class]{background:silver;}/*匹配所有拥有class属性的h1标签*/

*[title]{...}/*匹配有title属性的所有标签*/

a[href][title]{...}/*匹配同时拥有href和title属性的a标签*/

a[href="http://www.baidu.com"]{...}/*属性值匹配*/

a[href="http://www.baidu.com"][title="baidu"]{}/*同时满足...*/

```

## 样式的层叠特性

层叠：在同一优先级下，后声明的属性会覆盖已经声明的同一属性。



#选择器的权值

当两个选择器匹配到了同一个元素，并且为这个元素设置了同一个属性如border，浏览器会使用权值高的那个选择器

```css

p{color:red;} /*权值为1*/

p span{color:green;} /*权值为1+1=2*/

.warning{color:white;} /*权值为10*/

p span.warning{color:purple;} /*权值为1+1+10=12*/

#footer .note p{color:yellow;} /*权值为100+10+1=111*/

```



#属性匹配查询选择器

```css

a[class^=icon]{  background: green;  color:#fff; } //查询class以icon开头的a元素

a[href$=pdf]{  background: orange;  color: #fff; } //查询href以pdf结尾的a元素

a[title*=more]{  background: blue;  color: #fff; } //查询title中包含more字段的元素 

```



#:not

`div:not([id="footer"]){ background: orange;}` //除了div的id为footer的选择器





#:empty

`div:empty { border: 1px solid green;}`  选择的是里面没有内容的div元素



#：target  `<a href="#target_id">`元素的目标触发的选择器

```

#brand:target {

  background: orange;

  color: #fff;

}

#jake:target {

  background: blue;

  color: #fff;

}

#aron:target {

  background: red;

  color: #fff;

}

<h2><a href="#brand">Brand</a></h2>

<div class="menuSection" id="brand">

  content for Brand

</div>

<h2><a href="#jake">Brand</a></h2>

<div class="menuSection" id="jake">

 content for jake

</div>

<h2><a href="#aron">Brand</a></h2>

<div class="menuSection" id="aron">

    content for aron

</div>

```

#:first-child 匹配到的列表中第一个元素

```

<style>

ol > li{

  font-size:20px;

  font-weight: bold;

  margin-bottom: 10px;

}

ol a {

  font-size: 16px;

  font-weight: normal;

}

ol > li:first-child{

  color: red;   //先选中ol下所有li子元素,再取第一个

}

</style>

<ol>

  <li><a href="##">Link1</a></li>

  <li><a href="##">Link2</a></li>

  <li><a href="##">link3</a></li>

</ol>

```

#:last-child 匹配到的列表中最后一个元素



# :nth-child(n) 根据n匹配列表中的数据

`nth-child(3)` 匹配第三个

`nth-child(2n)` 匹配偶数项

`nth-child(2n+1)` 匹配偶数项

```css

<style>

    ol > li:nth-child(2n){  background: orange; }

</style>

<ol>

  <li>item1</li>

  <li>item2</li>

  <li>item3</li>

  <li>item4</li>

  <li>item5</li>

  <li>item6</li>

  <li>item7</li>

  <li>item8</li>

  <li>item9</li>

  <li>item10</li>

</ol>

```

:nth-last-child(n) 与上一个一样，不同的是从最后一个元素开始计算



# :first-of-type 选取第一个特定类型(如div)的元素 

# :last-of-type  选取最后一个特定类型(如div)的元素 

```

.wrapper > div:first-of-type {

  background: orange;

}

```



# ：nth-of-type(2n) 也是指某种特定类型的，参考:nth-child(n)

# ：nth-last-of-type(n) 表示从最后一个元素开始计数

```

.wrapper > p:nth-of-type(2n){  background: orange; }

```



# :only-child 匹配父类元素中唯一的一个元素

# ：only-of-type 匹配父类元素中唯一的一个特定类型的元素



# :enabled 可用性选择器

```

input[type="text"]:enabled {   background: #ccc;   border: 2px solid red; }

```

# :disabled 跟上一个相反



# :checked 用于被选中状态的单选或复选框



# 匹配用鼠标选中了文本的状态

```

::-moz-selection {  background: red;  color: green; } 

::selection {  background: red;  color: green; }

```



# ：read-only 选中拥有只读属性的元素

给表单设置 readonly="readonly" 属性

```

input[type="text"]:-moz-read-only{

  border-color: #ccc;

}

input[type="text"]:read-only{

  border-color: #ccc;

}

```

# :read-write 与:read-only相反



# ::before 和 ::after 在元素前后插入内容

```


.clearfix::before,

.clearfix::after {

    content: ".";

    display: block;

    height: 0;

    visibility: hidden;

}

.clearfix:after {clear: both;}

.clearfix {zoom: 1;}

```
