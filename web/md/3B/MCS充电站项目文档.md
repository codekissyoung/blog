# 项目目录结构
## mcs 主目录
```shell
├── alipaynotify.php　# 支付宝支付成功后，支付宝服务器回调文件
├── alipay.php　　# 支付宝网关文件,处理支付宝事件消息，比如登录注册，主菜单按钮事件等
├── api_test　# 项目api接口测试脚本,使用curl请求模拟调用api接口
├── cfg.inc.php　# 项目主配置文件
├── common.func.inc.php # 项目公用函数库文件
├── composer.json　# composer json 配置文件
├── composer.lock　# composer lock 配置文件
├── composer.phar # composer 脚本，用于下载更新composer库
├── crontab.php　# 定时脚本文件，用于检查订单超时，执行退款等任务,使用linux crontab 脚本定时执行
├── data -> ../../../data　# 项目数据存放目录
├── discuz_plugin_mcs.xml　# discuz 插件脚本
├── env_cfg.inc.php　# 测试环境配置文件，里面的配置会覆盖cfg.inc.php文件里面的配置
├── error_define.cfg.php　# 错误定义配置文件
├── favicon.ico　# 项目小图标
├── func.inc.php　# 项目公用函数库
├── index.php　# 项目入口文件
├── install.php　# discuz 插件安装文件，用于安装本项目
├── lbs　# lbs查找充电站功能的文件目录
├── lib　# 公用类库目录
├── mcs.lang.php　# 语言配置文件
├── mod　# 项目划分模块目录
├── model　# 项目模型文件目录
├── MP_verify_HdikKx6Jz7ChKjRr.txt　# 验证文件
├── MP_verify_rIzGFkXlv5a9PdMH.txt　# 验证文件
├── seller.php　
├── static　# javascript css img 静态文件目录
├── sync.php # 充电站同步文件
├── table　# 项目数据库表文件目录
├── tasks　#
├── template # 项目模板文件
├── update_user_statistics　# 更新用户统计数据脚本
├── update_weixin_userinfo　# 更新微信用户脚本
├── vendor　# composer 各种库目录
├── wxpaynotify.php　# 微信支付成功后，微信服务器回调文件
├── wxpay.php　#　充电宝租赁业务文件
├── wx.php # 微信网关文件 ,处理微信事件消息,比如微信用户登录注册，主菜单按钮事件等
└── zhimanotify.php　# 芝麻信用支付成功后,支付宝回调文件
```

## mcs/mod 项目模块划分目录
```shell
├── act
│   ├── api　# 接口目录
│   │   ├── common.php # 通用接口
│   │   ├── menu.php　# 商品相关接口
│   │   ├── pay.php　# 支付相关接口
│   │   ├── station.php　# 充电站相关接口
│   │   └── user.php　# 用户相关接口
│   ├── cp　# 充电站管理目录
│   │   ├── adapter.php　# 充电线　充电头管理
│   │   ├── ad.php　# 广告管理
│   │   ├── common.php　# 通用
│   │   ├── data.php　# 数据分析统计管理
│   │   ├── fee_strategy.php　#　收费策略管理
│   │   ├── finance_data.php　#　每日收入数据管理
│   │   ├── install_man.php　#　安装维护管理
│   │   ├── item.php　#　商品管理
│   │   ├── material.php　#　图片素材管理
│   │   ├── order.php　#　订单管理
│   │   ├── pwd.php　#　密码管理
│   │   ├── refund.php　#　退款管理
│   │   ├── settings.php　#　充电站设置
│   │   ├── shop.php　#　商铺管理
│   │   ├── station.php　#　充电站管理
│   │   └── user.php　#　用户管理
│   └── wechat
│       ├── shop.php　#　充电站页面，商品售卖页面
│       └── user.php　#　用户页面
├── api.inc.php　# 接口模块路由文件,用于包含 mcs/mod/act/api 目录下文件
├── cp.inc.php　# 后台模块路由文件,用于包含 mcs/mod/act/cp 目录下文件
├── data.inc.php　# 数据模块
├── map.inc.php　# 地图模块
├── reg.inc.php　
├── remote_directive.inc.php
├── shop.inc.php
├── user_check.inc.php　# 用户登录检测模块
└── wechat.inc.php　# 移动端模块(包括微信和支付宝)路由文件，用于包含 mcs/mod/act/wechat 目录下文件
```
