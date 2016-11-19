# js 管理cookie

```javascript
// 设置Cookie
function setCookie(name,value,expires_seconds){
    var cookieString = name + "=" + escape(value);
    //判断是否设置过期时间
    if(expires_seconds > 0){
        var date=new Date();
        date.setTime(date.getTime() + expires_seconds * 1000);
        cookieString += "; expires=" + date.toGMTString() + "; path=/";
    }
    console.log(cookieString);
    document.cookie = cookieString;
}

// 获取Cookie
function getCookie(name){
    var strCookie=document.cookie;-
    var arrCookie=strCookie.split("; ");
    for(var i=0;i<arrCookie.length;i++){
        var arr=arrCookie[i].split("=");
        if(arr[0]==name) return arr[1];
    }
    return "";
}

// 删除Cookie
function delCookie(name){
    var date = new Date();
    date.setTime( date.getTime() - 10000 );
    document.cookie = name + "=v; expires=" + date.toGMTString();
}
```
