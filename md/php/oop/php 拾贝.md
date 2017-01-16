# switch
```php
switch($user_type){
    case "new_user":
        // 跳转到注册页面
        break;

    case "super_vip_user":
        // 初始化超级用户相关特权

    case 'vip_user':
        // 初始化vip用户相关特权

    case 'common_user':
        // 初始化用户都拥有的特权
        break;

    default:
        // default code
        break;
}
```
> 代码解释
- 如果是新用户，它会直接跳出到登录界面
- 如果是超级用户,会执行3个初始化
- 如果是vip用户，就只会初始化vip用户相关特权和用户都拥有的特权
