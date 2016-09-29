#discuz_table 内置的方法

* `C::("#mcs#mcs_menu");`

```
count(); // 获取表的行数

update(键值,$data)  // 更新键值数据

insert($data, $return_insert_id,$replace)  //  插入数据

fetch_all($ids) // fetch 数据，可以是单一键值或者多个键值数组

fetch_all_field()  // fetch所有的字段名表

range($start, $limit, $sort) // fetch值域范围

```
hehe