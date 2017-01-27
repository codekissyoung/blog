<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<h1>Hello world 你好世界!</h1>
<h2>Hello world 你好世界!</h2>
<h3>Hello world 你好世界!</h3>
<h4>Hello world 你好世界!</h4>
<h5>Hello world 你好世界!</h5>


<ul>
	<li>列表1</li>
	<li>列表1</li>
	<li>列表1</li>
	<li>列表1</li>
</ul>

<ol>
	<li>列表1</li>
	<li>列表1</li>
	<li>列表1</li>
	<li>列表1</li>
</ol>

<table>
	<thead>
		<tr>
			<th>项目1</th>
			<th>项目2</th>
			<th>项目3</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> 111 </td>
			<td> 222 </td>
			<td> 333 </td>
		</tr>
		<tr>
			<td> 111 </td>
			<td> 222 </td>
			<td> 333 </td>
		</tr>
		<tr>
			<td> 111 </td>
			<td> 222 </td>
			<td> 333 </td>
		</tr>
	</tbody>
</table>

<dl>
	<dt>dt dt</dt>
	<dd>dd dd dd</dd>
	<dd>dd dd dd</dd>
</dl>

<p>just for p tag 强调字体 <strong>strong 强调</strong></p>
<q>我测试下引用</q>
<blockquote>长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试长引用测试</blockquote>
<address>文档编写：lilian 北京市西城区德外大街10号</address>
<address> 本文的作者：<a href="mailto:lilian@imooc.com">lilian</a></address>



<form method="传送方式"   action="服务器文件" enctype=multipart/form-data>
	<label for="username" autofocus>用户名:</label>
	<input type="text"  name="username" id="username" value="" />
	<label for="pass" >密码:</label>
	<input type="password"  name="pass" id="pass" value="" required/>
	<input type="submit" value="确定"  name="submit" />
	<input type="reset" value="重置" name="reset" />
	<textarea  rows="行数" cols="列数">文本</textarea>
	<span>男</span><input id=man type=radio name=sex value=male checked>
	<span>女</span><input id=women type=radio name=sex value=female>
	<!-- name 属性作为键名，value 是值,checkbox 传给服务器的是一name为名的数组(在php中) -->
	<input type=checkbox name=vehicle[] value=Bike>自行车 
	<input type=checkbox name=vehicle[] value=Car checked>汽车
	<input type=checkbox name=vehicle[] value=air>飞机 
	<select name="hobby">
      <option value="看书" selected="selected">看书</option>
      <option value="旅游">旅游</option>
      <option value="运动">运动</option>
      <option value="购物">购物</option>
    </select>
	<select name="hobby" multiple="multiple">
      <option value="看书" selected="selected">看书</option>
      <option value="旅游">旅游</option>
      <option value="运动">运动</option>
      <option value="购物">购物</option>
    </select>
</form>
<style>
	.test-inline{
		color:red;
		
	}
	.test-inline span{
		padding-left:100px;
		margin-left:50px;
	}
</style>
<p class="test-inline">
	<span>测试inline</span>
</p>


</body>
</html>



