# MySQL
```sql
select s.id,s.mac,ss.shopid,ss.station_id,sh.name,sh.city from ycb_mcs_station as s left join ycb_mcs_shop_station as ss on s.id = ss.station_id  left join ycb_mcs_shop as sh on ss.shopid = sh.id
```

# 查询参考
```
/**
 * sample:
 *      C::t('#mcs#mcs_user')
 *      ->select('id, uid')
 *      ->where(['id' => 1,  'ids' => [1,2,3], 'update_time' => ['value' => $time, 'glue' => 'like']])
 *      ->group('status, type')
 *      ->order('id desc')
 *      ->limit(1, 20)
 *      ->get()/first()/count()/getResAndCount()
 */
```

# 文件命名规范
- 被普通程序文件，或引用程序文件引用的函数库或类库，以 .func.php(函数库) 或 .class.php(类库) 后缀命名。
- 模板文件，以 .htm 后缀命名，插件模板文件存在于 source/plugin/identifier/template/ 目录中，手机版插件模板存在于 source/plugin/identifier/template/mobile/目录中
- 模板语言包文件，以 .lang.php 后缀命名，插件语言包文件开发时存放于 data/plugindata/ 目录中，文件名为identifier.lang.php。
- 动态缓存文件，存放于 ./data/cache 目录中，依据不同的功用进行独立的命名。
- 使用后台数据备份功能生成的备份文件，通常以 .sql 为后缀，存放于 data/ 目录中。
- 有些目录中存在内容为空白的 index.htm 文件，此类文件是为了避免 Web 服务器打开 Directory Index 时可能产生的安全问题。
- 从 Discuz! X2.5 开始，产品对数据表进行了封装，封装后的文件统一命名为 Table 类，通过`C::t(Table类文件名)`方式调用。
- 插件如需封装自己的数据表，可将 Table 类文件存放于 source/plugin/identifier/table/ 目录下，并以 table_表名.php 格式命名

# class_core.php
- `source/class/class_core.php` 是 Discuz! 的通用初始化模块程序，其几乎被所有的外部代码所引用，在您开始插件设计之前，可以先对该模块的大致功能做一定的了解。class_core.php 主要完成了以下任务：
- 对不同 PHP 及操作系统环境做了判断和兼容性处理，使得 Discuz! 可以运行于各种不同配置的服务器环境下。
- 初始化常量 IN_DISCUZ 为 TRUE，用于 include 或 require 后续程序的判断，避免其他程序被非法引用。
- 读取社区程序所在绝对路径，存放于常量 DISCUZ_ROOT 中。
- 加载所需的基本函数库 source/function/function_core.php。
- 通过 config/config_global.php 中提供的数据库账号信息，建立数据库连接。Discuz! 支持数据表的前缀，如需获得表的全名，可使用“DB::table('tablename')”方式。
- 判断用户是否登录，如登录标记 $_G['uid'] 为非 0，同时将 $_G['username']（加了 addslashes 的用户名，可用于不加修改的插入数据库）、 $_G['member']['username']（原始的用户名，可用于页面显示）、$_G['member']['password']（用户密码的MD5串）等相应用户信息赋值，其他用户信息存放于 $_G['member']，更多信息可通过“getuserprofile()”获取。
- 判断用户管理权限，将管理权限标记 $_G['adminid'] 为 1~3 中间的值。0 代表普通用户；1 代表论坛管理员；2 代表超级版主；3 代表论坛版主。 将用户权限按照其所在的主用户组 ID 标记为 $_G['groupid']，相关权限从该 $_G['groupid'] 所对应的系统缓存中读出，存放于 $_G['group']。
预置读入了每个模块的各种设置变量。
- [X2.5变更内容] $_G['username'] 将不进行 addslashes 处理。


# 原则
- 所有与插件的程序，包括其全部的前后台程序，请全部放入 source/plugin/ 目录中，同时在插件的安装说明中指出，插件的文件需要复制到哪些目录。为了避免与其他插件冲突，请尽量建立 source/plugin/ 下的子目录，并将插件程序放置于子目录下，这样您编写的插件将获得更好的兼容性。
- 如果您的插件包含“导航栏”模块，该模块将统一用 plugin.php?identifier=xxx&module=yyy 的方式调用，请在相应链接、表单中使用此方式。其中 xxx 为插件的惟一标识符，yyy 为模块名称。前台插件外壳程序 plugin.php 已经加载了通用初始化模块/source/class/class_core.php，不需再次引用。

- 如果您的插件包含“管理中心”模块，该模块将统一用 `admin.php?action=plugins&identifier=xxx&pmod=yyy` 的方式调用，请在相应链接、表单中使用此方式。其中 xxx 和 yyy 的定义与“导航栏”模块中的相同。

系统还允许用 `admin.php?action=plugins&edit=$edit&pmod=$mod 的方式来生成链接和表单地址，$edit 和 $mod 变量已经被插件后台管理接口赋值，因此将这两个变量值带入 URL 中也是被支持的。由于后台模块是被 admin.php 调用，因此已加载了通用初始化模块 /source/class/class_core.php 并进行了后台管理人员权限验证，因此模块程序中可直接写功能代码，不需再进行验证。

- 请勿绕过插件的前后台外壳（plugin.php 和 admin.php）而以直接调用某程序的方式编写插件，因为这样既导致了用户使用不便，代码冗余和不规范，同时又产生了因验证程序考虑不周到而带来的安全隐患。您可以在任何地方，包括链接、表单等处方便的使用上述 URL 地址对插件模块进行调用。
所有与插件有关的程序，包括全部的前台程序，因全部使用外壳调用，请务必在第一行加入
```
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
```
后台程序第一行加入
```
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
```
以免其被 URL 直接请求调用，产生安全问题。

一般情况下，您发布插件请使用插件导出的功能，以方便使用者一次性导入插件的配置数据，极特殊的情况下，也可以分步骤告知使用者如何进行插件配置管理和安装此插件。

- 如果功能独立，请尽量使用单独程序的方式编写插件（即外挂型插件），而尽量少的对论坛本身代码进行修改，这将为使用者今后的升级带来很大方便。
- 您可以修改 Discuz! 本身的数据结构，但更推荐在不很影响效率的前提下将插件数据用另外的数据表存储，因为不能排除您增加的字段或索引和今后版本 Discuz! 核心数据字段重名的可能。在任何情况下，请不要删除 Discuz! 标准版本数据结构中已有的字段或索引。
请在插件说明书中对插件做以详尽的描述，例如增加了哪些字段、哪些表，修改了或新增了哪些程序，版本兼容性，后续支持的提供方式（例如不提供支持，或以什么样的方式提供）。
- 如果方便，请尽可能提供插件的卸载方法，例如去除哪些字段、删除哪些新增的程序、将哪些被插件修改的程序恢复原状等等，使用者会感激您为此付出的辛勤劳动，甚至愿意支付相应的费用支持您未来的发展。

- 如果插件使用另外的数据表存储，请在插件管理中准确的设置插件所使用的数据表名称（不包含前缀），这样用户在备份数据的时候，能够把插件数据一同备份。
- Discuz! 内置了 8 种自定义积分，存储于 common_member 表中的 extcredits1 至 extcredits8 字段中，类型为有符号整数。


# C::("#mcs#mcs_menu");
C::t插件调用方式
```
表名:mytablename
目录:source/plugin/mypluginid/table/table_mytablename.php
类名:table_mytablename
用法:C::t('#mypluginid#mytablename')->method();
```


```
count(); // 获取表的行数

update(键值,$data)  // 更新键值数据

delete(键值)	删除键值数据

truncate()	清空表

insert($data, $return_insert_id,$replace)  //  插入数据

fetch_all($ids) // fetch 数据，可以是单一键值或者多个键值数组

fetch_all_field()  // fetch所有的字段名表

range($start, $limit, $sort) // fetch值域范围

optimize() // 优化表


// 在table类里面常用的
public function count_by_field($k,$v) {
    return DB::result_first('SELECT COUNT(*) FROM %t WHERE %i ', array($this->_table, DB::field($k, $v)));
}

public function fetch_by_field($k,$v) {
    return DB::fetch_first('SELECT * FROM %t WHERE %i ', array($this->_table, DB::field($k, $v)));
}

public function fetch_all_by_field($k, $v, $start = 0, $limit = 0) {
    return DB::fetch_all('SELECT * FROM %t WHERE %i '.DB::limit($start, $limit), array($this->_table, DB::field($k, $v)));
}

```

# DB 类
```
DB::table($tablename)	获取正确带前缀的表名，转换数据库句柄，
DB::table('mcs_menu'); // return ycb_mcs_menu

DB::field($key,$value[,$operation])  构造查询字符串
DB::field('name','codekissyoung');  // `name` = 'codekissyoung'
DB::field('tags',['111','222','333',444],'notin') // `tags` NOT IN('111','222','333','444')
DB::field('address', '%' . '测试下' . '%', 'like') // `address` LIKE('%测试下%')
DB::field('adaptercount2', 100, '>=') // `adaptercount2`>='100'

DB::limit(m[,n]) // 返回limit条数限制
DB::limit(3,10) // LIMIT 3, 10
DB::limit(4) // LIMIT 4

DB::order(别名, 方法)	排序
DB::order('id',true) // `id` DESC
DB::order('id') // `id` ASC

DB::query($sql)	// 普通原生查询 返回结果集　, 还需要从结果集里取出数据, 不推荐使用
DB::result_first($sql,占位符替换数据数组)	查询结果集的第一个字段值 , 不推荐使用
DB::fetch(结果集)	// 从结果集中取关联数组，注意如果结果中的两个或以上的列具有相同字段名，最后一列将优先, 不推荐使用
DB::fetch_all($sql,占位符替换数据数组,作为键值的字段); // 查询数据，内部使用DB::query() ，返回已经从结果集里取出的二维数组
DB::fetch_all('SELECT * FROM %t WHERE uid > %d LIMIT %d', ['common_member', '100', '10'], 'uid');
// 占位符
// %t DB::table()
// %d intval()
// %s addslashes()
// %n IN (1,2,3)
// %f sprintf('%f', $var)
// %i 直接使用不进行处理
DB::fetch_first($sql,占位符替换数据数组)	// 取查询的第一条数据

DB::insert($tablename, 数据(数组),是否返回插入ID,是否是替换式,是否silent)	 // 插入数据操作

DB::update($tablename, 数据(数组),condition)	// 更新操作 更新数据 data 为 `['字段'=>'值',...]` condition 为字符串 ,或者 [字符串，字符串]使用 and 链接

DB::num_rows(结果集)	// 获得记录集总条数, 不推荐使用

```

# 数据层的规范和约定
```
1. 方法名以下划线分隔，全部为小写，全部为单数，直接返回结果，保留关键字：on、get、set, 方法参数不能以数组的形式传入，数据可以；

2. 查询结果返回一行记录方法名使用fetch开头，返回多行记录方法名使用fetch_all开头，查询中使用SQL语句count函数返回一个数值的使用count开头;

3. 方法名中by后面的是以下划线(_)分隔的表字段名，不要使用复数型，例如： fetch_all_by_uid()而不是fetch_all_by_uids();

4. 方法名需去掉表名，如：common_member表类方法 fetch_member_by_username应命名为fetch_by_username；

5. 数据表类继承discuz_table基类，基类实现CURD操作,fetch方法实现了根据一个主键值得到一行记录,fetch_all方法实现了根据一组主键值得到多行记录（二维数据，主键值为 key）
count方法返回了表的总记录数据；如果表是无主键或是关联主键，则基类中的CURD将不能使用，需自己在相应的表类中实现， 同时将$this->_pk设置为空；

6. DB层封装的函数实现了addslashes，个别直接写sql语句的需主意addslashes；
```

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
