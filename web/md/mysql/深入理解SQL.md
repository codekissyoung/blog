# sql执行顺序
`FROM -> WHERE -> GROUP BY -> HAVING -> SELECT -> DISTINCT -> UNION -> ORDER BY -> LIMIT`
* FROM 才是 SQL 语句执行的第一步，并非 SELECT 。数据库在执行 SQL 语句的第一步是将数据从硬盘加载到数据缓冲区中，以便对这些数据进行操作
* SELECT 是在大部分语句执行了之后才执行的，严格的说是在 FROM 和 GROUP BY 之后执行的。理解这一点是非常重要的，这就是你不能在 WHERE 中使用在 SELECT 中设定别名的字段作为判断条件的原因。
* 无论在语法上还是在执行顺序上， UNION 总是排在在 ORDER BY 之前。也就是说，先进行聚合，再排序。

```sql
SELECT A.x + A.y AS z
FROM A
WHERE z = 10;  # z 在此处不可用，因为SELECT是最后执行的语句！

SELECT A.x + A.y AS z
FROM A
WHERE (A.x + A.y) = 10; # 重新写一遍 z 所代表的表达式
```

# SQL 语言的核心是对表的引用（table references）
```sql
FROM a, b # 两个表的笛卡尔积 组成的新表
```
- 上面这句 FROM 语句的输出是一张联合表，联合了表 a 和表 b 。如果 a 表有三个字段， b 表有 5 个字段，那么这个 输出表 就有 8 个字段。
这个联合表里的数据是 `a * b`，即 a 和 b 的笛卡尔积。换句话说，也就是 a 表中的每一条数据都要跟 b 表中的每一条数据配对。如果 a 表有3 条数据， b 表有 5 条数据，那么联合表就会有 15 条数据。
- FROM 输出的结果被 WHERE 语句筛选后要经过 GROUP BY 语句处理，从而形成新的输出结果。
- 从集合论（关系代数）的角度来看，一张数据库的表就是一组数据元的关系，而每个 SQL 语句会改变一种或数种关系，从而产生出新的数据元的关系,即产生新的表


# ON 条件 vs Where 条件 vs Having 条件
- ON 条件用在表的连接，比如　`from A left join B on A.xxx = B.xxx`
- Where 条件 在表的连接完成后执行，用于筛选记录 `form ... where A.xxx = xxx`
- Having 条件用在where完成筛选，并且再进行`group by`分组之后，用于对分组进行筛选，`group by xxx having count(*) > 2` 用于筛选出记录数多于２个的分组