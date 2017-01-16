概述
=====================

1. api环境列表
```
测试环境 host : http://m.dev.yunchongba.com
```
1. 所有接口调用推荐使用 `post` 请求 ( ps:get请求也可以 )
1. **`api` 地址格式** : `host/index.php?mod=api&act=模块&opt=操作`
1. **接口描述格式**
> `模块/操作`　接口名称 (实际调用时替换为相应的api`url`地址格式)
```
 // 传参参考,格式为`json`字符串描述,调用时替换为`post`请求格式
{
    'mac' : 'cc79cf231ef6', // 机器的mac地址
}
```
```
// 返回参考
{
    data : {}
    code : 0,
    msg : 'success',
}
```

# 充电站相关接口

## `mod=api&act=station&opt=menu_category_list` 充电站商品类目列表
```
{sid:5014}
```
```
{
  "data": {
    "categorys": [
      {
        "id": "1",
        "name": "默认商品",
        "pre_category_id": "0",
        "icon": "http://ycb.cky.lingyunstrong.com/data/attachment/forum/1701/10/img/qoI01484030440iDRW.png",
        "status": "0"
      },
      ...
    ]
  },
  "code": 0,
  "msg": "成功"
}
```

## `mod=api&act=station&opt=menu_list` 充电站商品列表
```
{
    sid:5014,
    category_id:3
}
```
```
{
  "data": {
    "menus": [
      {
        "menu_id": "5",
        "hook_number": "1118",
        "price": "2.00",
        "amount": "0",
        "subject": "纸巾",
        "carousel": "http://ycb.cky.lingyunstrong.com/data/attachment/forum/201609/20/180344ji2xsxfzys81p3ip.jpg",
        "category_id": "3",
        "update_time": "2017-01-09 16:30:40",
        "buy_url": "http://ycb.cky.lingyunstrong.com/index.php?mod=wechat&act=shop&opt=pay&sid=5014&menu_id=5&hook_number=1118"
      },
      ...
    ],
    "count": 6
  },
  "code": 0,
  "msg": "成功"
}

```

## `mod=api&act=station&opt=shipments` 充电站详情列表
```
{
    orderid:MCS-20170110-142618-05270,
    status:2
}
```
这是一个多用途接口：根据status的值表示不同的操作

// 2 表示该商品正在出货中, 订单状态　1 -----> 2

// 3 表示该商品已经出货完成,订单状态　2 ------> 3

// 4 以上表示出货失败状态    1 , 2 ----> 4 以上
```
{
  "data": {
    "menus": {
      "MCS-20170110-142618-05270": {
        "orderid": "MCS-20170110-142618-05270",
        "menu": "iphone充电线",
        "menu_id": "10",
        "hook_number": "1116",
        "sid": "5014",
        "openid": "oMKCQw3qHAwuFbr-w7BZlL60qp64",
        "uid": "122",
        "pay_amount": "0.01",
        "pay_time": "1484029578",
        "status": "1",
        "create_time": "1484029578",
        "update_time": "1484029583"
      }
    }
  },
  "code": 0,
  "msg": "成功"
}

```


# 错误码说明

```
0 => '成功返回数据'
```


-----------------------------------------------

# 其他接口

# sync.php
## mod=sync_setting 机器升级配置策略接口
get 参数
```
sid=137 充电站id
version=1 软件版本
device_ver=31 机器版本
sign=9d2ff13fe142eb415f1cb0db0c8845ffd1e6e527 签名校验相关
nonce=1469505365191564 签名校验相关
```

# 第三方接口

## 充电站百度定位
get url `https://api.map.baidu.com/geosearch/v3/nearby?callback=?`
```
{
    'q' : city, // 查询城市　eg. '深圳市'
    'filter' : 'enable:1',
    'region' : '',
    'geotable_id' : "{GEOTABLE_ID}",
    'sortby' : 'distance:1',
    'radius' : 100000,
    'bounds' : '',
    'page_size': 8,
    'page_index' : page_index,
    'ak' :"{BAIDU_MAP_JS_AK}",　//
    'location' : current_point.lng+','+ current_point.lat,
}
```

```
{
    "status": 0,
    "total": 15,
    "size": 8,
    "contents": [
        {
            "empty": 0,
            "enable": 1,
            "usable": 0,
            "uid": 1743633977,
            "province": "广东省",
            "geotable_id": 117126,
            "district": "宝安区",
            "sid": 0,
            "create_time": 1468210488,
            "city": "深圳市",
            "location": [
                114.040884,
                22.629446
            ],
            "address": "广东省深圳市宝安区民田路119号",
            "title": "民治1980文化创意园",
            "coord_type": 3,
            "direction": "东南",
            "type": 0,
            "distance": 9993,
            "weight": 0
        },
        ...
    ]
}
```
