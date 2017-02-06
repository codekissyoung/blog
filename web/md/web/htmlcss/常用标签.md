# `<strong>`
用于修饰强调的文本 ，比如打折后的价格

#`<span>`
标签是没有语义的，它的作用就是为了设置单独的样式用的

#`<q>`
短文本引用

# `<blockquote>`
长文本引用

# `<br>`
分行显示文本
# 地址
`<address>文档编写：lilian 北京市西城区德外大街10号</address>`

# 邮件
`<address> 本文的作者：<a href="mailto:lilian@imooc.com">lilian</a></address>`

#`<code>`

代码里面不能用来显示html标签代码

```
<code>
	<p>hello world</p>
	<h1>hahah</h1>
</code>
```
# `<pre>`

保留空格和换行符

```
<pre>
var message="欢迎";
for(var i=1;i<=10;i++)
{
    alert(message);
}
</pre>
```

#列表

有序列表

```
<ul>
  <li>精彩少年</li>
  <li>美丽突然出现</li>
  <li>触动心灵的旋律</li>
</ul>
```

无序列表

```
<ol>
   <li>前端开发面试心法 </li>
   <li>零基础学习html</li>
   <li>JavaScript全攻略</li>
</ol>
```
#表格

```
<table summary="表格简介文本">
 <caption>标题文本</caption>
  <tbody>
    <tr>
      <th>班级</th>
      <th>学生数</th>
      <th>平均成绩</th>
    </tr>
    <tr>
      <td>一班</td>
      <td>30</td>
      <td>89</td>
    </tr>
    <tr>
      <td>二班</td>
      <td>35</td>
      <td>85</td>
    </tr>
  </tbody>
</table>
```

* table表格在没有添加css样式之前，在浏览器中显示是没有表格线的

* 表头，也就是th标签中的文本默认为粗体并且居中显示

* `table tr td,th{border:1px solid #000;}`可以给`td``th`添加上边框,而`tr`是不能加边框的

#`<a>`链接

```
<a  href="目标网址"  title="鼠标滑过显示的文本" target="_blank">链接显示的文本</a>
```
* 链接的网页是在当前浏览器窗口中打开，有时我们需要在新的浏览器窗口中打开`target="_blank"` 

```

//短横线是搜索引擎更容易接受的方式 

http://www.yoursite.com/notable-architects/20th-century/buckminster-fuller.html 

http://www.site.com/tofu/ 

ftp://ftp.site.com/pub/proposal.pdf" 

mailto:somename@somedomain.com 

```

#  图片
```
<img src="图片地址" alt="下载失败时的替换文本" title = "提示文本">
```
#表单
```
<form method="传送方式"   action="服务器文件" enctype=multipart/form-data>
      <label for="username" autofocus>用户名:</label>
      <input type="text"  name="username" id="username" value="" />
      <label for="pass" >密码:</label>
      <input type="password"  name="pass" id="pass" value="" required/>    
      <input type="submit" value="确定"  name="submit" />
      <input type="reset" value="重置" name="reset" />
      <textarea  rows="行数" cols="列数">文本</textarea>
</form> 
```
* type

   当`type="text"`时，输入框为文本输入框;

   当`type="password"`时, 输入框为密码输入框。

* name 为文本框命名，以备后台程序ASP 、PHP使用。

* value 为文本输入框设置默认值(一般起到提示作用)

* cols ：多行输入域的列数 rows ：多行输入域的行数。两个属性可用css样式的width和height来代替：col用width、row用height来代替

* 在`<textarea></textarea>`标签之间可以输入默认值
* `autofocus`一张网页只能有一个input能设置autofocus获得焦点 
* `required` 必填字段

单选框 多选框

```
<span>男</span><input id=man type=radio name=sex value=male checked>
<span>女</span><input id=women type=radio name=sex value=female>
<!-- name 属性作为键名，value 是值,checkbox 传给服务器的是一name为名的数组(在php中) -->
<input type=checkbox name=vehicle[] value=Bike>自行车 
<input type=checkbox name=vehicle[] value=Car checked>汽车
<input type=checkbox name=vehicle[] value=air>飞机 
```

* value：提交数据到服务器的值（后台程序PHP使用）

* name：为控件命名，以备后台程序 ASP、PHP 使用

* checked：当设置`checked="checked"`时，该选项被默认选中

* 同一组的单选按钮，name 取值一定要一致，比如上面例子为同一个名称`radioLove`，这样同一组的单选按钮才可以起到单选的作用

下拉选择框

```
    <select name="hobby" multiple="multiple">
      <option value="看书" selected="selected">看书</option>
      <option value="旅游">旅游</option>
      <option value="运动">运动</option>
      <option value="购物">购物</option>
    </select>
```
* 在 widows 操作系统下，进行多选时按下Ctrl键同时进行单击（在 Mac下使用 Command +单击），可以选择多个选项

label 标签的 `for`属性中的值应当与相关控件的 id 属性值一定要相同,这样点击lable时会触发对应的表单

```
<form>
   <label for="male">男</label>
  <input type="radio" name="gender" id="male" />
  <br />
  <label for="female">女</label>
  <input type="radio" name="gender" id="female" />
  <br />
  <label for="email">输入你的邮箱地址</label>
  <input type="email" id="email" placeholder="Enter email">
</form>
```

#link 标签
```
<link rel="stylesheet" media="screen" href="style.css" /> 
```


# article 

article 元素表示文档、页面、 应用或网站中一个独立的容器,原 则上是可独立分配或可再用的,就 像聚合内容中的各部分。它可以是 一篇论坛帖子、一篇杂志或报纸文 章、一篇博客条目、一则用户提交 的评论、一个交互式的小部件或小 工具,或者任何其他独立的内容项。

其他 article 的例子包括电影或音乐评 论、案例研究、产品描述,等等。你或许惊 讶于它还可以是交互式的小部件或小工具, 不过这些确实是独立的、可再分配的内容项 



# section

section 元素代表文档或应用的一个一般的区块。在这里,section 是具有相似主题的一组内容,通常包含一个标题。

section 的例子包含章节、标签式对话框中的各种标签页、论文中 带编号的区块。比如网站的主页可以分成介绍、新闻条目、联系信息等区块。

尽管我们将 section 定义成“通用的”区 块,但不要将它与 div 元素(参见 3.12 节)混淆。 从语义上讲,section 标记的是页面中的特定 区域,而 div 则不传达任何语义 



# aside

aside 的例子还包括重要引述、侧 栏(图 3.10.3)、指向相关文章的一组链接(通 常针对新闻网站)、广告、nav 元素组(如博 客的友情链接),Twitter 源、相关产品列表(通 常针对电子商务网站),等等 



# role 

可以帮助用户识别页面区域,从而 让屏幕阅读器用户可以直接跳到这些区域 

`role="banner"`(横幅) 

将其添加到页面级的 header 元素,每个页面只用一次 

面向全站的内容,通常包含网站标志、网站赞助者标志、 全站搜索工具等。横幅通常显示在页面的顶端,而且通 常横跨整个页面的宽度 

`role="navigation"`(导航)

文档内不同部分或相关文档的导航性元素(通常为链接) 的集合

与 nav 元素是对应关系。应将其添加到每个 nav 元素, 或其他包含导航性链接的容器。这个角色可在每个页面 上使用多次,但是同 nav 一样,不要过度使用该属性

`role="main"` (主体) 

文档的主要内容 

与 main 元素是对应关系。最好将其添加到 main 元素, 也可以添加到其他表示主体内容的元素(可能是 div)。 在每个页面仅使用一次 

`role="complementary"` (补充性内容) 

文档中作为主体内容补充的支撑部分。它对区分主体内 容是有意义的 

与 aside 元素是对应关系。应将其添加到 aside 或 div 元 素(前提 是该 div 仅包含补充性内容)。可以在一个页 面里包含多个 complementary 角色,但不要过度使用 

`role="contentinfo"` (内容信息) 

包含关于文档的信息的大块可感知区域这类信息的例子 包括版权声明和指向隐私权声明的链接等 

将其添加至整个页面的页脚(通常为 footer 元素)。每个页面仅使用一次 
















