# `C::("#mcs#mcs_menu")`

`count();`  获取表的行数

`update(键值,$data)`   更新键值数据

`insert($data,false,true) `  插入数据 , data 为 ['字段'=>'值',...]

`fetch_all($ids)`  fetch 数据，可以是单一键值或者多个键值数组

`fetch_all_field()`   fetch所有的字段名表

`range($start, $limit, $sort)`  fetch值域范围

# DB 类

`DB::fetch_all($sql)` 查询数据

`DB::fetch_all('SELECT * FROM %t WHERE uid > %d LIMIT %d', array('common_member', '100', '10'), 'uid');`

格式化：
```
%t DB::table()
%d intval()
%s addslashes()
%n IN (1,2,3)
%f sprintf('%f', $var)
%i 直接使用不进行处理
```


`DB::field()` 构造查询字符串

```
DB::field('name','codekissyoung'); // name = `codekissyoung`

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

`DB::table("mcs_menu");`    ycb_mcs_menu ; ycb 是数据库表前缀名

`DB::delete($table,$condition)`  condition 为字符串 ,或者 [字符串，字符串]使用 and 链接

`DB::insert($table,$data,false,true);` 插入一条数据 , data 为 `['字段'=>'值',...]`

`DB::update($table,$data, $condition);` 更新数据 data 为 `['字段'=>'值',...]` condition 为字符串 ,或者 [字符串，字符串]使用 and 链接

# 数据层的规范和约定

一个数据表一个class文件，以table_加上不带前缀的表名命名，尽量不操作其它表；

不能使用$_G、$POST、$GET等全局变量；

关联查询(JOIN)尽量拆分为单条查询，不能拆分的放入主表的类中；

方法名以下划线分隔，全部为小写，全部为单数，直接返回结果，保留关键字：on、get、set, 方法参数不能以数组的形式传入，数据可以；

除数据表文件以外，其它文件禁止出现SQL语句；

查询结果返回一行记录方法名使用fetch开头，返回多行记录方法名使用fetch_all开头，查询中使用SQL语句count函数返回一个数值的使用count开头;

方法名中by后面的是以下划线(_)分隔的表字段名，不要使用复数型，例如： fetch_all_by_uid()而不是fetch_all_by_uids();

方法名需去掉表名，如：common_member表类方法 fetch_member_by_username应命名为fetch_by_username；

数据表类继承discuz_table基类，基类实现CURD操作,fetch方法实现了根据一个主键 值得到一行记录、fetch_all方法实现了根据一组主键值得到多行记录（二维数据，主 键值为 key）、count方法返回了表的总记录数据；

如果表是无主键或是关联主键，则基类中的CURD将不能使用，需自己在相应的表类中实现， 同时将$this->_pk设置为空；

DB层封装的函数实现了addslashes，个别直接写sql语句的需主意addslashes；

使用C::t('tablename')->method();调用；

C::t插件调用方式
```
表名:mytablename
目录:source/plugin/mypluginid/table/table_mytablename.php
类名:table_mytablename
用法:C::t('#mypluginid#mytablename')->method();
```
