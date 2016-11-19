# 嵌套
```
<!--{template common/header}-->
```

# 直接输出变量
```
<div id="anc"><ul id="ancl">$announcements</ul></div>
<!--{echo cutstr($group[lastpost][subject], 30)}-->
```

# 条件判断
```
如果写在HTML表单元素中，可以省去使代码更清晰易读，如{if $my_var}xxx{/if}
<!--{if $_G['uid']}--> 任意html语句 <!--{/if}-->

带有分支条件的if写法
<!--{if $_G['uid']}--> 任意html语句 <!--{elseif $_G[connectguest]}--> 任意html语句 <!--{/if}-->

带有多条件的if写法，可使用PHP常规判断中的按位运算符等
<!--{if empty($_G['forum']['picstyle']) && $_GET['orderby'] == 'lastpost' && empty($_GET['filter']) }-->
任意html语句
<!--{/if}-->

css书写时也可以按条件进行判断设置设置例如
<td class="fl_g"{if $forumcolwidth} width="$forumcolwidth"{/if}>
```


# 循坏
```
带有数组键的循环写法
<!--{loop $my_arr $key $val}-->
    循环输出的HTML语句
<!--{/loop}-->

没有数组键的循环写法
<!--{loop $_G['setting']['navs'] $nav}-->
    循环输出的HTML语句
<!--{/loop}-->
```

# 执行php语句
```
<!--{eval echo $my_var;}-->
<!--{eval $my_arr = array(1, 2, 3);}-->
<!--{eval print_r($my_arr);}-->
<!--{eval output();}-->
<!--{eval exit();}-->
```
