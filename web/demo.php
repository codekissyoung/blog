<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>菜鸟教程(runoob.com)</title>
<meta name="viewport" content="width=device-width,user-scalable=0"/>
<style>
div
{
	width:100px;
	height:100px;
	background:red;
	animation:myfirst 5s;
	-webkit-animation:myfirst 5s; /* Safari and Chrome */
}

@keyframes myfirst
{
	from {background:red;}
	to {background:yellow;}
}

@-webkit-keyframes myfirst /* Safari and Chrome */
{
	from {background:red;}
	to {background:yellow;}
}
myHero {
	display: block;
	background-color: #ddd;
	padding: 50px;
	font-size: 30px;
}
</style>
</head>
<body>

<p><b>注意:</b> 该实例在 Internet Explorer 9 及更早 IE 版本是无效的。</p>
<a href="#">测试超链接</a>
<div>
</div>

<myHero>我的第一个新元素</myHero>

<script>
	document.createElement("myHero");
	if(typeof(Storage)!=="undefined")
	{
		console.log('support');
	    // 是的! 支持 localStorage  sessionStorage 对象!
	    // 一些代码.....
	} else {
	    // 抱歉! 不支持 web 存储。
		console.log('can not support');
	}
</script>
</body>
</html>
