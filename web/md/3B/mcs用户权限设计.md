# 表设计
## 管理员表 ycb_mcs_admin
```
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `name` varchar(255) NOT NULL COMMENT '真实姓名',
  `pwd` varchar(255) NOT NULL COMMENT '加密后密码',
  `salt` char(8) NOT NULL COMMENT '加密随机盐值',
  `email` varchar(255) NOT NULL COMMENT '公司邮箱',
  `company` varchar(255) NOT NULL COMMENT '所属公司',
  `role_id` int(11) NOT NULL COMMENT '用户角色',
  `login_error` int(11) NOT NULL COMMENT '登录错误次数 (超过失败次数锁定账户，成功就刷新为0)',
  `create_time` datetime NOT NULL COMMENT '注册时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `status` int(11) NOT NULL COMMENT '状态(-1删除，0申请，1申请通过,2账户被锁定)'
```

## 管理员登录表 ycb_mcs_admin_session
```
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间(每次访问操作均更新)'
```
﻿

# 管理员注册
1. 先判断用户名是否已经注册过,保证用户名的唯一性
1. 注册密码加密方式: `md5(原始密码+盐值)`　，盐值为随机生成的8位字符串

# 管理员登录
1. 只允许通过用户名　+ 密码方式验证登录，先判断该账户是否被锁定，是否通过申请,再判断密码是否正确
1. 登录成功，往浏览器设置cookie : MCS_SESSION ,同时将该 MCS_SESSION 存入ycb_mcs_admin_sessiion中，同时将login_error设置为0
1. 登录失败，login_error加１，超过30次就锁定该账户

# 管理员访问操作
1. cookie获取MCS_SESSION , 查询ycb_mcs_admin_session判断该session是否存在，是否过期(update_time是否超时30分钟)
1. 失败或者过期，则跳转到管理员登录界面
1. 成功，则更新ycb_mcs_admin_session的update_time 为当前时间
