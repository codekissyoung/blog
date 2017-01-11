概述
=====================

1. api环境列表
```
测试环境 host : http://m.dev.yunchongba.com
曹开彦 host : http://ycb.cky.lingyunstrong.com (只有内网可以访问)
```
1. 所有接口调用推荐使用 `post` 请求(ps:get请求也可以)

1. **`api` 地址格式** : `host/index.php?mod=api&act=模块&opt=操作`

1. **接口描述格式**
> `模块/操作`　接口名称 (实际调用时替换为相应的api`url`地址格式)
```
 // 传参参考,格式为`json`字符串描述,调用时替换为`post`请求格式
{
    'mac' => 'cc79cf231ef6', // 机器的mac地址
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

## `station / menu_category_list` 充电站商品类目列表
```
{
    'mac' => 'cc79cf231ef6', // 机器的mac地址
}
```
```
{
    "data":{
        "categorys":[
            {
                "id":"1",
                "name":"日用品",
                "pre_category_id":"0",
                "icon":[
                    "\/data\/attachment\/forum\/1609\/08\/img\/rTHM1473321391kIeg.jpg"
                ],
                "status":"0"
            },
            ...
        ]
    },
    "code":0,
    "msg":"成功"
}
```

## `station/menu_list` 充电站商品列表
```
{
    'mac' => 'cc79cf231ef6', // 机器的mac地址
    'category_id' => 52     // 目录id
}
```
```
{
    "data":{
        "menus":{
            "3":{
                "id":"4",
                "station_id":"39",
                "menu_id":"35",     // 商品id
                "slot_3b":"22",     // 商品所在卡槽
                "mount":"0",        // 商品剩余数量
                "price":"12.34",    // 商品售价
                "update_time":"2016-09-14 18:23:30",
                "status":"0",
                "category_id":"52",
                "carousel":[
                    "http:\/\/ycb.cky.lingyunstrong.com\/data\/attachment\/forum\/201609\/13\/182520w6x6ioikyh63355h.jpg"   //商品轮播图
                ],
                "subject":"新增商品",   // 商品名称
                "descri":"描绘问下商品"   // 商品描述
            },
            ...
    },
    "code":0,
    "msg":"success"
}
```

## 充电站详情列表
```
{
    station_ids : [23,123,45,67] // 充电站id数组
}
```
```
{
    "111": {
        "id": "111",
        "mac": "7cc709e365e9",
        "channelid": "4271168128305628464",
        "lbsid": "1708761035",
        "shopid": "15",
        "total": "0",
        "usable": "13",
        "empty": "14",
        "battery_adapter": "1",
        "slotstatus": "00060020000000000000000000b000",
        "sportstatus": "00000000",
        "colorcount": "银:13",
        "machine": "1",
        "sdcard": "1",
        "adaptercount": "0",
        "adaptercount2": "0",
        "cable": "3",
        "maincontrol": "0",
        "sync_time": "1476873309",
        "title": "宝安天虹",
        "desc": "undefined",
        "address": "广东省深圳市宝安区西乡大道",
        "bgimg": "",
        "version": "32",
        "device_ver": "1",
        "fee_settings": "5",
        "seller_id": "40",
        "station_setting_id": "0",
        "status": "0",
        "error_man": "",
        "network_status": 1,
        "shopname": "Face酒吧",
        "shoplogo": [
            "/data/attachment/forum/1609/27/img/oW6y1474965233PlAV.jpg"
        ],
        "shoplocate": "广东省深圳市南山区科技路9号",
        "shopcost": "500",
        "shopphone": "0755-82666699",
        "shopstime": "21:00",
        "shopetime": "05:30",
        "shopcarousel": [
            "http://m.dev.yunchongba.com/data/attachment/forum/201609/27/162938z3xvgx1xxb6tsw37.jpg",
            "http://m.dev.yunchongba.com/data/attachment/forum/201609/27/162938w5xudldxws50xmjo.jpg",
            "http://m.dev.yunchongba.com/data/attachment/forum/201609/27/162938g4q344411aq2hna1.jpg",
            "http://m.dev.yunchongba.com/data/attachment/forum/201609/27/162937gs9pqpqnpnr7hzp7.jpg",
            "http://m.dev.yunchongba.com/data/attachment/forum/201609/27/162937hwcen3ktfnk44xge.jpg",
            "http://m.dev.yunchongba.com/data/attachment/forum/201609/27/162937l2t0280h22merrr8.jpg"
        ]
    },
    ...
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
