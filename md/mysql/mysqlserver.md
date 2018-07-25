# MySQL Server

## 服务器的SQL模式

- `STRICT_ALL_TABLES` 和 `STRICT_TRANS_TABLES` 严格模式
- `TRADITIONAL` 模式
- `ANSI_QUOTES` 模式, 把 `"` 识别为一个标识符引用字符串
- `PIPES_AS_CONCAT` 把 `||` 当成标准的SQL字符串连接运算符
- `ANSI` 组合模式
- `mysqld --sal-mode="STRICT_ALL_TABLES,ANSI_QUOTES"` 在服务器启动时开启模式

```sql
mysql> set sql_mode = 'TRADITIONAL'; -- 修改本次会话为特定的 sql mode
mysql> set GLOBAL sql_mode = "TRADITIONAL"; -- 修改全局的的 sql mode,需要SUPER权限
mysql> select @@SESSION.sql_mode; -- 查看当前链接的 sql mode
mysql> select @@GLOBAL.sql_mode; -- 查看全局的 sql mode
```