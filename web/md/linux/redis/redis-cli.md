# 启动
```
redis-cli -h {host} -p {port} 链接redis服务器,交互式界面
redis-cli -h {host} -p {port} {command} 链接并且执行命令
redis-cli shutdown [save|nosave] 关闭redis服务器 [生成|不生成]持久化文件
```

# 通用命令
```
127.0.0.1:6379> keys * 显示所有健
127.0.0.1:6379> dbsize 健总数
127.0.0.1:6379> exists key_name 健是否存在
127.0.0.1:6379> del key_name 删除健
127.0.0.1:6379> del key1 key2 key3 删除多个健
127.0.0.1:6379> expire key_name 10 设置该健10s后过期
127.0.0.1:6379> ttl key_name 查看该健剩余过期时间, -1 表示没设置, -2 健不存在
127.0.0.1:6379> type key_name 查看该健的类型, string hash(哈希) list(列表) set(无序集合) zset(有序集合) , none 表示健不存在
127.0.0.1:6379> object encoding key_name 查看该健的内部实现编码，一种redis类型往往有几种内部编码实现
```

# 存取字符串
```
redis 127.0.0.1:6379> set name "yiibai.com"
OK
redis 127.0.0.1:6379> get name
"yiibai.com"
```

#
