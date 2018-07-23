# MySQL 和 Maria DB 管理

## 登录

```bash
mysql -hlocalhost -uroot -p951010
```

## 管理用户

```sql
-- 创建一个可以从服务器本地登录服务器的用户
-- localhost 换成 * , 则是允许用户在任意机器远程登录
mysql> create user 'cky'@'localhost' identified by 'password1234';

-- 将 practice_db 数据库的所有权限赋给 cky 用户
mysql> grant ALL PRIVILEGES on `practice_db`.* to 'cky'@'localhost';

-- all 表示所有权限，也可指定部分权限
mysql> grant SELECT, INSERT, UPDATE, REFERENCES, DELETE, CREATE, DROP, ALTER, INDEX,
mysql> CREATE VIEW, SHOW VIEW ON `practice_db`.* TO 'cky'@'localhost';

-- 查看当前用户权限
mysql > show grants;
+---------------------------------------------------------------------+
| Grants for root@localhost                                           |
+---------------------------------------------------------------------+
| GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION |
| GRANT PROXY ON ''@'' TO 'root'@'localhost' WITH GRANT OPTION        |
+---------------------------------------------------------------------+
```

## 管理数据库

```sql
-- 列出当前服务器所有数据
mysql> show databases;

-- 切换到指定数据库
mysql> use db_name;

-- 查看某个数据库的创建消息
mysql> show create database db_name;

-- 查查运行状态
mysql> show status;
mysql> show errors;
mysql> show warnings;
mysql> select user(),now(),version(),database();

-- 查看编码
-- Character_set_client 客户端使用的编码
-- Character_set_connection 数据库连接使用的编码
-- Character_set_results 返回结果使用的编码
mysql> show variables like %character_set_%;
mysql> set character_set_client = utf8; -- 设置编码
mysql> set names utf8; -- 设置所有编码为utf8

-- 选则一个数据库后，执行一个sql文件
mysql> source /var/www/mysql.sql;
-- 导入数据到mydb2库
mysql -hlocalhost -uroot -pCky951010 mydb2 < \var\www\mydb2.sql;
```

## 管理数据表

### 字段的数据类型

- 整数型 `int(11)` `bigint(20)` `tinyint(4)`
- 字符串型 `char(12)` 定长字符串 `varchar(255)`
- `enum('male','famale')` enum 是单选
- `set('football','basketball','ball')` set 是多选
- 查询集合数据,ccc字段是 set 类型，查询含有 a 的记录
- `float(M,D) double(M,D) decimal(M,D)`小数型, M 是有效位数，D是小数位数
- `datetime("2015-3-28 11:11:11") timestamp(2038年之前)` 时间型
- 添加纪录时，默认article_time 为当前时间，更新时也是
- 字段约束 `primary key， unique， not null， auto_increment， unsigned， default 10， zerofill`
- 注释 `comment "我是注释"`

```sql
select * from set111 where find_in_set('a',ccc) > 0;
create table test (article_time timestamp default current_timestamp on update current_timestamp)；
```

### 创建数据表

```sql
create [temporary]  table [if not exists] table_name
（
    [字段名 字段类型 字段约束 注释]，
    [字段名 字段类型 字段约束 注释]
    ...
);

create tabel article (article_id int(10) primary key );
create tabel article (article_id int(10),[...],primary key(article_id));

primary key (article_id , time); # 组合主键

create table article (...owner SMALLINT UNSIGNED NOT NULL REFERENCES person(id)); # 外键
foreign key (article_id) references main_table_name (category) [On update][On delete]; # 外键

# 主表主键更新时，会报冲突，表示你主表的主键是不允许更新的
foreign key (article_id) references main_table_name(category) On update restrict;

# 在删除主表的记录时，将与该记录有关的从表记录的那个foreign字段设置为 null
foreign key (article_id) references main_table_name(category) On update On delete set null;
# 删主表记录时，将从表记录(与主表记录有关的)也删除
on delete cascade

# 给表设定数据库引擎和编码
create table article (...)ENGINE = InnoDB DEfAULT CHARSET = utf8 default character set utf8;

# 给字段设定校对集
nikename varchar(25) character set utf8

show tables; # 列出表
desc table_name; # 查看表结构
show create table tb_name; # 查看创建表的语句

drop [temporary] table [if exists] table_name [, table_name];# 删除表
```

### 更新表

```sql
-- 修改表字段属性
alter table table_name +　新的字符集和校对规则;

-- 改变表明里的字段
alter table table_name change 旧字段名+新字段名 + 新字段的属性;

-- 添加字段
alter table table_name add 字段名 + 字段属性  after/before 字段名;

-- 删除字段
alter table 表名 drop 字段名;

-- 修改表的名字
rename table  old_table_name to new_name , old_table_name2 to new_name2;

-- 添加一个外键
Alter table tbl_name add foreign key (class_id) references main_tbl_name(class_id) on delete set null;

-- 删除外键
Alter table tbl_name drop foreign_key_name;
```

### mysql 日志管理

```bash
-- 版本 5.7.13
cat /etc/mysql/mysql.conf.d/mysqld.cnf`

# 所有sql操作语句都会被纪录下来
general_log_file = /var/log/mysql/mysql.log
general_log = 1
# 纪录mysql运行错误
log_error = /var/log/mysql/error.log
＃ 慢查询日志
log_slow_queries = /var/log/mysql/mysql-slow.log
# 超过2s
long_query_time  2
```

## 免密码登录

```bash
➜  ~ cat /home/cky/.my.cnf
[client]
host=localhost
user='root'
password='Cky951010'
➜  ~ chmod 400 .my.cnf
```

## 导入数据

```sql
$>mysql -hlocalhost -uroot -p mydb2 < \var\www\mydb2.sql
```

## 改变 my.ini 文件

```sql
memory_limit=128M;
upload_max_filesize= 2M ; /*增大限制大小*/
post_max_size=8M ;
character-set-server = utf8;
```

## 管理mysql日志

```sql
显示日志
mysql＞show binary logs;
mysql＞show master logs;
删除日志
PURGE MASTER LOGS TO 'mysql-bin.000035';
手动删除10天前的mysql binlog日志
mysql＞PURGE MASTER LOGS BEFORE DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY);
```

## 查看mysql参数

```
mysql＞show variables like '%max%';
```

## 字符函数 ##
```
char_lenngth() 返回的字符的长度
length() 返回字节长度
min(birth)　最小值
max(birth)　最大值
avg(birth)    平均值
count(＊)       符合条件的记录的个数
sum（ｃｏｌｕｍｅ）　该列的和
now()
curdate()
curtime()
adddate('2007-02-02', interval 31 day)
SELECT VERSION()　当前版本
CURRENT_DATE　当前时间常数
```

## 为何使用数据库 ##
```
为了有效的存储应用软件产生的数据，和高效的访问它们！
```
## 优良的设计 ##
 - 少冗余
 - 杜绝数据维护异常
 - 高效访问

## 数据库设计步骤 ##

 1. 需求分析
```
要存哪些数据?数据自身的特点？数据之间的关系？
实体是什么?实体与表之间不是一一对应的关系。实体之间的关系(１对1,1对多，多对多)。实体的标识(主健)，实体的记录的增长速度。
时效性:（用户登录 session之类）的数据要按时清理，
增长性: (有些开发人员，喜欢将访问日志存库，这种数据增长是非常快的，必须制定好清理规则　)
```
 2. 逻辑设计
```
ER图分析，实体，实体关系
```
 3. 物理设计
```
选数据库软件，建表，考虑字段类型
```
 4. 维护优化
```
建立／优化索引，大表拆分，新需求建表。
```

## 异常 ##

 - 插入异常
```
一个实体依赖另一个实体而存在的情况下，容易出现。比如：
往一个不存在的班级里面加学生。
```
 - 更新异常
```
更新某个学生的信息，却修改了多条记录。
```
 - 删除异常
```
删除某个实体记录时，连带另外一个实体的信息也被删除了。
比如：删除某个班里最后一名学生，学生对应的班级也会被删除(如果是在一张表里)
```

## 范式 ##

 - 第一范式 　:   字段不可拆分
 - 第二范式　 :  单关键字（只有一个字段作为主键）都符合第二范式，双关键字(两个字段组合标识一个实体记录)表中，部分字段分别依赖两个关键字，就不符合第二范式。第二范式目的是：消除部分依赖。
```
解决方案：将这个表拆成３个表，两个关键字作为主键各自成一张表。再加一张它们之间的对应关系表。
例子：
价格，描述，重量，有效期，分类　依赖于　商品名称，供应商电话依赖于供应商名称，存在问题：
１，冗余，试想　表中有　n 个饮料一厂，其供应商电话就冗余了。
２，更新异常：我想改动下饮料一厂的电话，改动了 n 条数据。其他异常可以推理
```
![这里写图片描述](http://img.blog.csdn.net/20150919203948446)
 

 - 第三范式：表里面某些字段（可以不是关键字）依赖另一些字段，就是不符合第三范式。
```
解决办法：拆成3张表，如下图　。
例子：
存在传递依赖关系：　商品名称－>分类－>分类描述，试想同一分类多了，分类描述不就冗余了吗？
更新异常：假如我更新　酒水饮料　的分类描述，那么分类是酒水饮料的商品记录都会被更新。
```
![这里写图片描述](http://img.blog.csdn.net/20150919204817922)

 - BC　范式：复合关键字之间有依赖关系。目的是：消除两组关键字之间的相互依赖关系。
```
解决办法：拆表，如下。
例子：
假如饮料二厂并没有给我们提供商品，那么它的供应商联系人的数据存哪儿?丢弃么？
```
![这里写图片描述](http://img.blog.csdn.net/20150919205416842)

## 设计数据库的一些技巧 ##
 - ﻿表垂直拆分设计 1 对 1 关系设计
```
拆分常用字段 和 不常用字段，分别用一张表存储，用一个 唯一标识 id 来链接
```
 - 水平拆分设计 
```
如果一张表的记录超过了100万条，那就应该将它们分为两张一样的表，每张表存储 50 万条记录
```
 - 实体与实体之间的 n 对 1 关系设计
```
比如学生(n) 对 班级 (1) ：在学生表里面加一个从属字段(所属班级)，并加上外键约束
```
 - 实体与实体之间的 n 对 n 关系设计
```
通过在两张实体表之间，添加一张关系表，专门记录两个实体之间的对应关系
```