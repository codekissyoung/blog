# 连接数据库
```sql
$ mysql -hlocalhost -uroot -p951010
```

# 管理数据库
```sql
mysql > show databases; # 列出数据库
mysql > use db_name;    # 使用哪个数据库
mysql > show create database db_name; # 查看这个数据库的创建消息
mysql > show status; # 查查运行状态
mysql > show errors; #
mysql > show warnings; #

mysql > show variables like %character_set_%; # 查看编码
# Character_set_client 客户端使用的编码
# Character_set_connection 数据库连接使用的编码
# Character_set_results 返回结果使用的编码
mysql > set character_set_client = utf8; # 设置编码
mysql > set names utf8; # 设置所有编码为utf8

mysql > source /var/www/mysql.sql; # 选则一个数据库后，执行一个sql文件
mysql -hlocalhost -uroot -pCky951010 mydb2 < \var\www\mydb2.sql  # 导入数据到mydb2库

mysqldump -hlocalhost -uroot -pmydb_dbname > \var\www\mydb.sql  # 导出数据库mydb_dbname到文件

# 查看状态
mysql > select user(),now(),version();
+----------------+---------------------+-----------------------------+
| user()         | now()               | version()                   |
+----------------+---------------------+-----------------------------+
| root@localhost | 2016-12-28 13:07:31 | 5.7.16-0ubuntu0.16.04.1-log |
+----------------+---------------------+-----------------------------+
mysql> select database(); # 当前数据库
+------------+
| database() |
+------------+
| ycb        |
+------------+

```
### 自动备份mysql中数据库的脚本
```bash
#!/bin/sh
today=`date +%Y%m%d`
filename=${today}_fleamarket_backup.sql
mysqldump -uroot -pCky951010 fleamarket > ./fleamarket-back-up/${filename}
```

# 数据表
```sql
create [temporary]  table [if not exists] table_name（[字段名 字段类型 字段约束 注释] ，[字段名 字段类型 字段约束 注释]);

create tabel article (article_id int(10) primary key ); # 主键
create tabel article (article_id int(10),[...],primary key(article_id)); # 主键

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

LOAD DATA LOCAL INFILE “D:/mysql.txt” INTO TABLE my_table; # 导入数据到表
select name,age,city,salary into outfile "c:/data_out.txt" lines terminated by “/r/n” from person; # 导出到txt文件

drop [temporary] table [if exists] table_name [, table_name];# 删除表

```

## 更新表
`alter table table_name change 旧字段名+新字段名 + 新字段的属性`
改变表明里的字段
`alter table table_name add 字段名+字段属性  after/before 字段名;`
添加字段
`alter table 表名 drop 字段名;`
删除字段
`alter table table_name +　新的字符集和校对规则;`
修改表的表选项
`rename table  old_table_name to new_name , old_table_name2 to new_name2;`
修改表的名字
`Alter table tbl_name add foreign key (class_id) references main_tbl_name(class_id) on delete set null;`
添加一个外键
`Alter table tbl_name drop foreign key 外键名称(mysql帮我们生成的，需要使用show create table tbl_name 去查看);`
删除外键


### 数据类型
整数型 int(11)   bigint(20) tinyint(4)
字符串型 char(12)：定长字符串  varchar(255)
`enum('male','famale')` enum 是单选
`set('football','basketball','ball')` set 是多选
`select * from set111 where find_in_set('a',ccc) > 0; `
 查询集合数据,ccc字段是 set 类型，查询含有 a 的记录 ！
`float(M,D) double(M,D) decimal(M,D)`小数型, M 是有效位数，D是小数位数
`datetime("2015-3-28 11:11:11") timestamp(2038年之前)` 时间型
`create table test (article_time timestamp default current_timestamp on update current_timestamp)；`
添加纪录时，默认article_time 为当前时间，更新时也是
二进制型：`blob `
字段约束 `primary key，unique，not null，auto_increment ，unsigned，default 10 ，zerofill `
注释 `comment "我是注释"`

### datetime 比较大小问题
`select * from t1 where unix_timestamp(time1) > unix_timestamp('2011-03-03 17:39:05') and unix_timestamp(time1) < unix_timestamp('2011-03-03 17:39:52');`
或：
`time1 between '2011-03-03 17:39:05' and '2011-03-03 17:39:52';`

### 时间格式化函数 DATE_FORMA T(date, format)
%Y 年, 数字, 4 位
%m 月, 数字(01……12)
%d 月份中的天数, 数字(00……31)
%H 小时(00……23)
%i 分钟, 数字(00……59)
%s 秒(00……59)



# 管理用户
```sql
mysql > create user 'cky'@'dadishe.com' identified by 'secret'; # 创建用户,该用户可从dadishe.com主机访问数据
mysql > show grants; #  查看当前用户权限
+---------------------------------------------------------------------+
| Grants for root@localhost                                           |
+---------------------------------------------------------------------+
| GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION |
| GRANT PROXY ON ''@'' TO 'root'@'localhost' WITH GRANT OPTION        |
+---------------------------------------------------------------------+

# grant 命令,`test`.*是test库的所有表, TO 后面是用户，'localhost'是只允许本地，'*'的话则是允许用户远程登录
mysql > GRANT SELECT, INSERT, UPDATE, REFERENCES, DELETE, CREATE, DROP, ALTER, INDEX, CREATE VIEW, SHOW VIEW ON `test`.* TO 'test02'@'localhost'
```

### mysql 日志管理
版本 5.7.13
```bash
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

免密码登录
================================================================================
```bash
➜  ~ cat /home/cky/.my.cnf
[client]
host=localhost
user='root'
password='Cky951010'
➜  ~ chmod 400 .my.cnf 
```



