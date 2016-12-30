
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
