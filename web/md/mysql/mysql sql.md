# 语句顺序
```sql
select ... from ... where ... group by ... having ...order by ... limit
```

# select 
```sql
# 可以使用 as name 给查询结果设定别名用于显示
mysql> select concat (first_name ,' ',last_name) as name ,concat(city,', ',state) as Birthplace from president;
+-----------------------+-------------------------+
| name                  | Birthplace              |
+-----------------------+-------------------------+
| George Washington     | Wakefield, VA           |
| John Adams            | Braintree, MA           |

```

# 返回不重复值
```sql
select distinct a,b,c from tb_name; # 记录中，abc三个字段全相同才算重复
```

# 返回条数
```sql
... from tb_name limit 5   # 第1条起,返回 5 条
... from tb_name limit 3,5 # 跳过3条,返回 5 条
```

# 记录排列顺序
```sql
... from tb_name order by A asc,B desc　# 先按A升序排列，A列相同的再按B降序排列

# eg .
mysql> select last_name ,first_name, death from president order by death desc,last_name;
+------------+---------------+------------+
| last_name  | first_name    | death      |
+------------+---------------+------------+
| Ford       | Gerald R.     | 2006-12-26 |
| Reagan     | Ronald W.     | 2004-06-05 |
# death 是死亡日期，为null的人说明没死，应该按death排序的时候排在前面的,所以要采用下列语句
# if() 是函数，如果death is null 正确，则取值0,不正确则取值1,asc升序排列，0 在 1的前面
mysql> select last_name ,first_name, death from president order by if(death is null,0,1) asc , death desc , last_name asc;
+------------+---------------+------------+
| last_name  | first_name    | death      |
+------------+---------------+------------+
| Bush       | George W.     | NULL       |
| Bush       | George H.W.   | NULL       |
| Carter     | James E.      | NULL       |
| Clinton    | William J.    | NULL       |
| Obama      | Barack H.     | NULL       |
| Ford       | Gerald R.     | 2006-12-26 |
| Reagan     | Ronald W.     | 2004-06-05 |
```

# 过滤数据
```sql
... where A = 3  # 返回A列值为3的行
where A between 3 and 5 # 在3和5之间
where A is not null # 过滤A列中值为NULL的列,正常数据库设计中，不允许包含NULL
where id = 10 and price < 100
where id = 10 or id =34
where id =10 or id = 20 and price > 10 # AND 优先于 OR,得到所有id为10，以及id为20并且price>10的行
where (id = 10 or id =20) and price >10 # 得到id为10或者20，并且price>10的行
where id in (10,20,23) # 得到id为10,20,23的行
where id not in (29,34,53)  # 得到id不为29,34,53的行
where id in (select uid in tb_name where)  # in 与 select 结合使用
```

# 使用通配符过滤
```bash
where name like 'code%';  % 表示任意数量的字符,得到name以code开头的行
where name like '_abc';   _ 匹配任意一个字符,abc结尾的行
where name like 1000;     通配符是完全匹配,找出 name 为1000的行
```

# 使用正则表达式过滤 REGEXP 和 NOT REGEXP
```sql
where name REGEXP 1000;        正则是包含匹配,找出name包含1000的行
where name REGEXP 'jack|tom';  | 表示可选项，找出name包含jack或tom的行
where name REGEXP '[ABC]oop';  []表示范围 ，找出包含 Aoop,Boop,Coop 的名字
where name REGEXP '[^123]A';   ^在[]内，表示取反，找出包含aA,4A(第一个字符不为123) 的名字
where name REGEXP '[0-5]A';    - 表示范围,找出包含 0A,1A,2A,3A,4A,5A 的名字
WHERE name REGEXP '^b';        找出以b开头的名字
WHERE name REGEXP 'fy$';       找出以fy结尾的名字
WHERE name REGEXP '^.....$';   . 匹配任何单个的字符,找出5个字符的名字
where name REGEXP '^.{5}$';    {n} 表示重复前面的匹配，找出5个字符的名字
where name REGEXP '^.{5,}$';   找出5个字符以上的名字
where name REGEXP '^.{5,10}$'; 找出5个到10个字符的名字
where name REGEXP '^[abc]*';   *表示0次或多次 或以任意以a,aa,aaaa...b,bb...c,ccc...开头的名字
where name REGEXP '^.?$';      ? 等价于 {0,1}
where name REGEXP '^.+$';      + 等价于 {1,}
select 'abc' regexp '[0-9]';   在MariaDB中测试正则表达式:匹配返回 1，不匹配返回 0
```


数据汇总
================================================================================
```sql
# 聚合函数
avg()   对一列数据求平均数
min()   对一列数据求最小值
count() 对一列数据计数
sum()   对一列数据求和
max()   对一列数据求最大值
```

数据分组
================================================================================
```sql
select * from STAFF group by dept desc;
id  name  dept  salary  edlevel  hiredate
1 张三 开发部 2000 3 2009-10-11
2 李四 开发部 2500 3 2009-10-01
3 王五 设计部 2600 5 2010-10-02
4 王六 设计部 2300 4 2010-10-03
5 马七 设计部 2100 4 2010-10-06
6 赵八 销售部 3000 5 2010-10-05
7 钱九 销售部 3100 7 2010-10-07
8 孙十 销售部 3500 7 2010-10-06

# 分组查询+聚合函数 查出每个组中薪水最高的同事
SELECT DEPT, MAX(SALARY) AS MAXIMUM　FROM STAFF　GROUP BY DEPT;
DEPT  MAXIMUM
开发部 2500
设计部 2600
销售部 3500

# 先按vend_id，同一值的归为一组，然后在每个组的列中进行聚合操作,返回该列的聚合值(最大值/最小值/平均值之类的)
select vend_id,count(*) from products group by vend_id;

# where 在分组前过滤数据，having 在分组后过滤数据，先过滤掉pro_price小于10的，再分组，再过滤掉分组个数小于2的
select vent_id ,count(*) from products where pro_price >=10 group by vend_id having count(*) > 2;
```


子查询
================================================================================
```sql
... where order_num in (select order_num from ordertimes where pro_id = 'TNT2');

select cust_name ,(select count(*) from orders where orders.cust_id = customers.cust_id) as orders from customers order by cust_name; 查询每个用户的订单数

select * from goods where price >= ANY (select price from goods where type = "超级本"); ANY 和SOME 是一致的，只要大于等于子查询返回一个值就好，ALL是大于子查询返回的所有值

select * from goods where price　exists (select price from goods_detail where type = "超级本");
```

# 多表链接
```sql
select vend_name , prod_name ,prod_price from vendors,products where vendors.vend_id = products.vend_id; 内链接

select vend_name ,prod_name,prod_price from vendors as v inner join products as p on v.vend_id = p.vend_id; 内连接 性能更快

select p1.id,p1.name from products as p1,products as p2 where p1.id = p2.id and p2.id = '1213' 自连接，比使用子查询更快

select customers.name,orders.id from customers left join orders on customers.id = orders.cust_id 外连接 customers表的全部数据

select customers.name,count(orders.id) as orders_num from customers left join orders on customers.id = orders.cust_id group by customers.name 带聚合函数的连接 ,查询每位顾客的订单数(没有订单的就是0)
```

# 联合查询
将两个单独select语句查询到的结果放置到一个单一的查询结果中,必须是相同数量且顺序相同的列，并且数据类型类似，才能使用 Union 将结果集并到一起,结果集的字段名，取第一条select语句的，也可以使用 as 自己定别名！
```sql
select vend_id,prod_id,prod_price from products where prod_price <= 5
union select vend_id,prod_id,prod_price from products where vend_id in (1001,1002) order by vend_id;
```
与union all 的区别：union all 不会移除两个查询的重复值
web项目中经常会碰到整站搜索的问题，即客户希望在网站的搜索框中输入一个词语，然后在整个网站中只要包含这个词的页面都要出现在搜索结果中。由于一个web项目不可能用一张表就全部搞定的，所以这里一般都是要用union联合搜索来解决整个问题的。

```sql
select * from (SELECT `id`,`subject` FROM `article` WHERE `active`='1' AND `subject` LIKE '%调整图片%' ORDER BY `add_time` DESC ) as t1

union all select * from (SELECT `id`,`class_name` AS `subject` FROM `web_class` WHERE `active`='1' AND `class_name` LIKE '%调整图片%' ORDER BY `class_id` DESC) as t2

union select * from (SELECT `id`,`subject` FROM `article` WHERE `active`='1' AND (`subject` LIKE '%调整%' OR `subject` LIKE '%图片%') ORDER BY `add_time` DESC) as t3;
```

# 插入数据
插入多行数据
```sql
insert into student2 (student_id, sdudent_name, class_name, area)
values (11, 'zhang5', 'ios0208', 'hunan'),
(12, 'zhang6', 'php0318', 'beijing'),
(13, 'zhang7', 'java0307', 'tianjin');

replace into table_name (字段，字段) values (值，值); # 在发生唯一索引冲突时，插入自动变成替换

# 蠕虫复制
insert into table_name (字段，字段) select (字段，字段) from table_name2 [where 条件];
```


# 更新数据
```sql
update table_name set 字段 = 值,set 字段 = 值 where 条件;
```
UPDATE和REPLACE基本类似，但是它们之间有两点不同。
- UPDATE在没有匹配记录时什么都不做，而REPLACE在有重复记录时更新，在没有重复记录时插入。
- UPDATE可以选择性地更新记录的一部分字段。而REPLACE在发现有重复记录时就将这条记录彻底删除，再插入新的记录。也就是说，将所有的字段都更新了

# 删除数据
```sql
delete from table_name where ... ;
```








