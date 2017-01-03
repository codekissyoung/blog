# Boolen 对象
对象的比较看是否为同一引用
原始值比较则看是否相等,判断数组相等:长度一样,里面变量一样
`if('') //false`
`if(0)  //false`
`if(null) //false`
`if(undefined)//false`
`if(NaN)  //false`
`if('0') //true`
`if({}) //true`
`if([]) //true`
`if(function(){}) //true`

# Math 数学计算对象
`var a = 123.2312`
`a.toFixed(2); //123.23  精确到小数点后几位`
`parseInt("077");  // 77 解析成整数`
`parseFloat('.1'); // 0.1 解析成浮点数`
`Math.round(0.6);  //1 四舍五入`
`Math.ceil(0.4);   //1 向上去整`
`Math.floor(0.8);  //0 向下取整`
`Math.abs(-5);     //5 求绝对值`
`Math.random();    //返回一个随机数`
`Math.max(x,y,z);   //返回最大值`
`Math.min(x,y,z);   //返回最小`

# Date 时间对象
`getTime()`取到当前unix时间戳
`var date = new Date(2015,7,31);` Mon Aug 31 2015 00:00:00 GMT+0800 (CST)
`date.valueOf() //1440950400000 `时间戳
`var now = new Date();` 当前时间

# Function 函数对象
`eval('{a:b}')` 将里面的字符串用javascript解释器解析执行
`arguments ` 参数数组对象
`arguments.callee`

# Array 数组对象
`var  arr = []` 声明数组
`var Myarr = [[0 , 1 , 2 ],[1 , 2 , 3, ]]`二维数组
`arr['name_index'] = 111;` 使用索引添加值
`length`数组元素个数
`push(1,2,3)`在数组尾部添加一个元素,值可以是　数组，字符串，数值，对象，函数
`pop(var)` 在数组尾部删除一个元素
`unshift(var)` 在数组头部添加一个元素
`shift(var)` 在数组头部删除一个元素
`delete `删除数组元素,位置存在,值为undefined
`join(str)` 以str链接数组成字符串
`reverse()` 数组倒序
`sort()` 数组排序
`arr.sort(function(a,b){return a-b;})` 按数字大小进行排序
`concat()` 数组合并
`slice(index,last_index)` 返回数组片段
`splice(index,last_index)` 返回与slice相反的片段
`Object.prototype.toString.call(obj) === '[object Array]';`  判断数组
`console.log([3,4] instanceof Array);` true
`console.log({3,4} instanceof Array);` false

# 网页卷去的距离与偏移量
![test](md/web/untitled.png)

#　异常处理
```javascript
try{
    ...throw "异常发生了";
}catch(ex){
    console.log(ex);
}finally{
    console.log("解决错误的最后代码");
}
```
参考：
http://www.imooc.com/video/5909   https://www.zhihu.com/question/21583373

# 严格模式
`(function (){ "use strict"; //需要使用严格模式解析的代码})();`
http://www.imooc.com/video/5911
http://www.ruanyifeng.com/blog/2013/01/javascript_strict_mode.html
http://www.ibm.com/developerworks/cn/web/wa-ecma262/index.html
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Strict_mode

# 原始类型
string
boolean
number
null
undefine
包装对象的概念：原始变量可以使用其包装对象的方法和属性
类型检测 alert(typeof var)

# element = document.querySelector(selectors)
element 是一个 element 对象（DOM 元素）
selectors 是一个字符串，包含一个或是多个 CSS 选择器 ，多个则以逗号分隔

# elementList = document.querySelectorAll(selectors)
elementList 是一个non-live的 NodeList 类型的对象
selectors 是一个由逗号连接的包含一个或多个CSS选择器的字符串.
