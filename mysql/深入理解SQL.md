## sql执行顺序
* FROM -> WHERE -> GROUP BY -> HAVING -> SELECT -> DISTINCT -> UNION -> ORDER BY
* FROM 才是 SQL 语句执行的第一步，并非 SELECT 。数据库在执行 SQL 语句的第一步是将数据从硬盘加载到数据缓冲区中，以便对这些数据进行操作
* SELECT 是在大部分语句执行了之后才执行的，严格的说是在 FROM 和 GROUP BY 之后执行的。理解这一点是非常重要的，这就是你不能在 WHERE 中使用在 SELECT 中设定别名的字段作为判断条件的原因。
```
SELECT A.x + A.y AS z
FROM A
WHERE z = 10  //z 在此处不可用，因为SELECT是最后执行的语句！如果你想重用别名z，你有两个选择。要么就重新写一遍 z 所代表的表达式：
SELECT A.x + A.y AS z
FROM A
WHERE (A.x + A.y) = 10，
```
* 无论在语法上还是在执行顺序上， UNION 总是排在在 ORDER BY 之前。很多人认为每个 UNION 段都能使用 ORDER BY 排序，但是根据 SQL 语言标准和各个数据库 SQL 的执行差异来看，这并不是真的。尽管某些数据库允许 SQL 语句对子查询（subqueries）或者派生表（derived tables）进行排序，但是这并不说明这个排序在 UNION 操作过后仍保持排序后的顺序。

## SQL 语言的核心是对表的引用（table references）
* FROM a, b
上面这句 FROM 语句的输出是一张联合表，联合了表 a 和表 b 。如果 a 表有三个字段， b 表有 5 个字段，那么这个“输出表”就有 8 （ =5+3）个字段。
这个联合表里的数据是 a*b，即 a 和 b 的笛卡尔积。换句话说，也就是 a 表中的每一条数据都要跟 b 表中的每一条数据配对。如果 a 表有3 条数据， b 表有 5 条数据，那么联合表就会有 15 （ =5*3）条数据。
FROM 输出的结果被 WHERE 语句筛选后要经过 GROUP BY 语句处理，从而形成新的输出结果。我们后面还会再讨论这方面问题。
如果我们从集合论（关系代数）的角度来看，一张数据库的表就是一组数据元的关系，而每个 SQL 语句会改变一种或数种关系，从而产生出新的数据元的关系（即产生新的表）。

## group  by  的使用
```
create table if not exists salary (id int(10),name varchar(255),dept varchar(255),salary int(10),edlevel int(10),hiredate varchar(255));
insert into salary values (1,"zhangshang","develop",2000,3,'2009-10-11');
insert into salary values (2,"lishi","develop",2500,3,'2009-10-01');
insert into salary values (3,"wangwu","design",2600,5,'2010-10-02');
insert into salary values (4,"maliu","design",2300,4,'2010-10-03');
insert into salary values (5,"maqi","design",2100,4,'2010-10-06');
insert into salary values (6,"zhaoba","sales",3000,5,'2010-10-05');
insert into salary values (7,"qianjiu","sales",3100,7,'2010-10-07');
insert into salary values (8,"shunshi","sales",3500,7,'2010-10-06');
```
* 想得到薪水最高的那个人的信息，通过下面尝试发现并没啥卵用！
select dept,max(salary) as max_salary from salary;
* 想得到每个部门的最高薪水？　加了name 那个是想知道部门里谁的薪水最高？　然而并没有什么卵用
select dept,max(salary) as max_salary from salary group by dept;
select name,dept,max(salary) as max_salary from salary group by dept;
* 想得到每个部门，每个职称等级的最高薪水？ where  的执行顺序是在group  by 之前的，所以分组前，就将一些记录过滤掉了！
select dept,edlevel,max(salary) as max_salary from salary group by dept,edlevel;
select dept,edlevel,max(salary) as max_salary from salary where edlevel >3 group by dept,edlevel;
* 寻找雇员数超过2个的部门的最高和最低薪水？　having 是　group  之后执行的，表示分组后，每组个数大于两个的组留下！
select dept,max(salary) as max_salary,min(salary) as min_salary from salary group by dept having count(*) > 2 ;
* 寻找雇员平均工资大于3000的部门的最高和最低薪水：
select dept,max(salary) as max_salary ,min(salary) as min_salary from salary group by dept having avg(salary) > 3000;
