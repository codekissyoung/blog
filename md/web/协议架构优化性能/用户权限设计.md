# 表设计
## 管理员表 ycb_mcs_admin
```
`id` int(11) NOT NULL,
`username` varchar(255) NOT NULL COMMENT '用户名(唯一)',
`name` varchar(127) NOT NULL COMMENT '真实姓名',
`pwd` varchar(255) NOT NULL COMMENT '加密后密码',
`salt` varchar(255) NOT NULL COMMENT '盐值',
`email` varchar(127) NOT NULL COMMENT '邮箱',
`company` varchar(255) NOT NULL COMMENT '公司',
`role_id` int(11) NOT NULL COMMENT '角色id',
`login_error` mediumint(9) NOT NULL COMMENT '错误登录次数',
`create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
`update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
`status` mediumint(9) NOT NULL COMMENT '状态(-1删除，0申请，1申请通过，２账户被锁定)'
```

## 管理员登录表 ycb_mcs_admin_session
```
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间(每次访问操作均更新)'
```

## 管理员负责城市表　ycb_mcs_admin_city
```
`id` int(11) NOT NULL,
`admin_id` int(11) NOT NULL COMMENT '管理员id',
`city` varchar(255) NOT NULL COMMENT '管理员所负责的城市'
```

## 管理员负责商铺表　ycb_mcs_admin_shop
```
`id` int(11) NOT NULL,
`admin_id` int(11) NOT NULL COMMENT '管理员id',
`shop_id` int(11) NOT NULL COMMENT '管理员负责的商铺id'
```

## 管理员角色表　ycb_mcs_admin_role
```
`id` int(11) NOT NULL COMMENT 'id',
`role` varchar(255) NOT NULL COMMENT '管理员角色',
`create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '角色创建时间'
```

## 管理员权限角色关系表 ycb_mcs_admin_role_access_rel
```
`id` int(11) NOT NULL,
`role_id` int(11) NOT NULL COMMENT '管理员角色id',
`access` varchar(255) NOT NULL COMMENT '权限'
```


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
