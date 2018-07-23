# MySQL技术内幕里的SQL搜集

## 1.MySQL教程

```sql
-- count(*)统计查询到的行数, count(列名)只会统计所有非NULL值的数目
mysql> select count(*),count(email),count(expiration) from member;
-- 结果是 102 , 80, 96

-- count 和 distinct 一起使用，可以统计出查询结果里有多少个 不同的 非NULL值
-- 下面这句含义：查出美国有多少个不同的州曾经诞生过总统
mysql> select count(distinct state) from president;

-- 查询班里 男生和女生 各是多少
mysql> select count(*) from student where sex = 'f';
mysql> select count(*) from student where sex = 'm';

-- 使用 group by ，它可以统计出某一列里不同值分别出现过多少次
mysql> select sex,count(*) from student group by sex;
-- 查询每个州诞生的总统数
mysql> select state,count(*) from president group by state;
-- 查询一年每个月分别有多少位总统出生
mysql> select month(birth) as month, monthname(birth) as name, count(*) as count
mysql> from president group by name order by month;

-- having 子句，对group by之后的分组进行过滤
-- 查询出诞生过两位总统以上的州
mysql> select state,count(*) as count from president group by state having count >= 2;

-- 使用各种聚合函数 统计每场考试的最低分，最高分，总参考人数，平均分等等
mysql> select event_id,min(score),max(score),max(score) - min(score) + 1 as span,sum(score) as total,
mysql> avg(score) as average,count(score) as count from score group by event_id;

-- 使用 with rollup 子句 还可以针对每一列的结果，获得一个汇总行
-- 这样我们就可以知道 所有考试里的最低分，最高分，平均分 等
mysql> select event_id,min(score),max(score),max(score) - min(score) + 1 as span,sum(score) as total,
mysql> avg(score) as average,count(score) as count from score group by event_id with rollup;

-- 使用链接操作(join)从多个表里检索信息,对于两个表里字段名不同，可以直接用
mysql> select student_id, date, score, category from grade_event inner join score
mysql> on grade_event.event_id = score.event_id where date = '2012-09-01';

```