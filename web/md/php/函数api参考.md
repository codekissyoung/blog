# is系列
```php
<?php
// 类型符合就返回true
is_bool();
is_integer();
is_double();
is_string();
is_object();
is_array();
is_resource();
is_null();
is_callable(); // 确保传入的字符串是函数，能够被call_user_func()和array_walk()等函数调用
```

# 写http头
 返回json数据
```php
<?php
header("content-type:application/json ;charset = utf-8;");  // 返回json数据
header('HTTP/1.1 200 OK'); // 告诉浏览器，请求成功
header('HTTP/1.1 404 Not Found'); // 无此页面

// 以下3行 禁止浏览器缓存
header('Cache-Control:no-cache,no-store,max-age=0,must-revalidate');
header('Expires：Mon,26 Jul 1997 05:00:00 GMT');
header('Pragma:no-cache');

header('Refresh:10;url=http://www.baidu.com/'); //页面重定向,十秒钟后跳到　url
header('location:http://www.baidu.com'); // 向浏览器发送一条Http头信息，告诉它重定向到莫个网址
header("Access-Control-AllowOrigin:http://dev.kanjiebao.com"); //允许http://dev.kanjiebao.com 的　ajax 的跨域请求
```

# 加载所有配置文件
```php
<?php
// glob 是寻找与模式匹配的文件路径，组成数组
foreach (glob(ROOT_PATH.'config/*') as $file){
    require_once $file;
}
```

# 变量方法
```php
<?php
function ($method,$param){
    $this ->input ->$method($param);
}
```

# 使用 or 和 and 截断
```php
<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
isset($page_size) or exit("未设置page_size");
```

# 数字处理
```php
<?php
ceil(1243648.43464); // 向上取整 1243649
round(1243648.43464); // 四舍五入1243648
intval(1243648.43464); // 强制转换为整型1243648
```

# 加密函数
```php
<?php
$urlstr = urlencode("我是codekissyoung");
echo  urldecode($urlstr); // 汉字加密 解密，为了解决传输时，汉字符会丢失的问题
// 不可逆加密
md5("hehexiix23"); // md5散列值

crypt($some_string,'keyvalue'); // 使用秘钥加密
$str = 'apple';
echo sha1($str); // sha1 散列值
// 可逆加密
//  base64加解密
base64_encode($string);
base64_decode($string);
// convert_uudecode加解密
convert_uudecode($str);
convert_uuencode($str);
```
# 时间函数
```php
<?php
$timestamp=time(); // 拿到当前的时间戳
date_default_timezone_get(); // 得到当前时区
date_default_timezone_set('PRC'); // 设置默认时区为中国
date_default_timezone_set("Asia/Shanghai"); // 设置默认时区为中国
mktime(0,0,0,10,9,2014); //  定制时间 返回2014年9月10号的时间戳
date('Y年m日d天 H:i:s',time()); // 格式化的时间
strtotime($stringtime); // 时间字符串转时间戳
```
# 测试代码执行时间
```php
<?php
$start_time=microtime();
//...执行的代码
$end_time=microtime();
$execute_time=$end_time-$start_time;
```

# 字符串函数
```php
<?php
strstr($_POST['email'],'@'); // 判断是否包含子字符串
strpos($_POST['email'],'@'); // 返回找到的位置

// 将字符串切成数组
$pieces = explode(" ","piece1 piece2 piece3 piece4 piece5 piece6");
echo $pieces[0];
echo $pieces[1];

// list构造器
$data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user;
echo $pass;

// 将数组连成字符串　：在生成表格，生成 sql 语句方面有大用
$elements = array('a', 'b', 'c');
echo "<ul><li>" . implode("</li><li>", $elements) . "</li></ul>";
// array containing data
$array = array(
"name" => "John",
"surname" => "Doe",
"email" => "j.doe@intelligence.gov"
);
// build query...
$sql  = "INSERT INTO table";
// implode keys of $array...
$sql .= " (`".implode("`, `", array_keys($array))."`)";
// implode values of $array...
$sql .= " VALUES ('".implode("', '", $array)."') ";
echo $sql;

//Select name,email,phone from usertable where user_id IN (?,?,?,?,?)
$id_nums = array(1,6,12,18,24);
$nums_list = implode(',', $id_nums);
$sqlquery = "Select name,email,phone from usertable where user_id IN ($nums_list)";
echo $sqlquery;

//  将url 的　查询字符串　解析成数组
$str = "first=value&arr[]=foo+bar&arr[]=baz";
parse_str($str);
echo $first;  // value
echo $arr[0]; // foo bar
echo $arr[1]; // baz
parse_str($str, $output);
echo $output['first'];  // value
echo $output['arr'][0]; // foo bar
echo $output['arr'][1]; // baz
```

# 编码转换
```php
<?php
$str="编码转换";
iconv('UTF-8','GBK',$str); // 将$str内的函数转换为utf-8编码

echo mb_substr('这样一来我的字符串就不会有乱码^_^', 0, 7, 'utf-8'); //0开始，取7个字符
echo mb_strcut('这样一来我的字符串就不会有乱码^_^', 0, 7, 'utf-8');
echo mb_strlen("我是个好人","utf-8");
//mb_substr是按字来切分字符，而mb_strcut是按字节来切分字符，但是都不会产生半个字符的现象。

string htmlspecialchars(string str); // 不希望浏览器解析html标签
strtoupper('caokaiyan');
strtolower('CAOkaiyan'); // 字符串大小写转换
lcfirst($foo); // 首字母小写
ucfist('how do you do today?'); // How do you do today?`首字母大写
ucwords("how do you do today?");//How Do You Do Today ?`每个单词首字母大写
```

# 提取子字符串
```php
<?php
substr('abcdefghijklmnopqrstuvwxyz',0,8);//从下标为０开始，开始提取８个 :abcdefgh
substr('abcdefghijklmnopqrstuvwxyz',20);//从下标为 20 开始，提取到最后 :　vwxyz
substr('abcdefghijklmnopqrstuvwxyz',-5);//提取倒数５个字符串　：vwxyz
substr('abcdefghijklmnopqrstuvwxyz',-5,3);//从倒数５个开始，提取３个：　vwx
substr('abcdefghijklmnopqrstuvwxyz',-5,-1);//从倒数　５　个开始，提取到倒数　1 个　: vwxy
```

# 替换字符串
```php
<?php
substr_replace('abcdefghijklmnopqrstuvwxyz','***',0,8); // ***ijklmnopqrstuvwxyz 后面的两个数字的参数的使用方法跟substr 一样：
// 判断数据是合法的json字符串
function is_json($string) {
	json_decode($string); 
	return (json_last_error() == JSON_ERROR_NONE);
}
```

# 数组函数
```php
<?php
// 给数组添加一个元素
$arr[] = "caokaiyan";//键为数字键
$arr['xuehao'] = 1001121213;
array_push($array,$var);

// 删除数组中的元素
unset($arr['xuehao']);
$var = array_pop($array);//$var 获取数组最后一个元素,数组减去那个元素
$array2 = array_unique($array);//删除数组中重复的元素

// 数组计数
$array2 =array(array('PHP1','php2','php3'),array('asp1'));
echo count($array2,COUNT_RECURSIVE);//后面标志表示递归

// 遍历数组中的元素　key和value 都是副本 , 修改value 的值不会影响到　$arr
foreach($arr as $key => $value){     print   '键 :'.$key.'   值：'.$value;}

// 遍历数组 $value 是引用 ,　修改$value 的值会影响到　$arr
$arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
    $value = $value * 2;
} // $arr is now array(2, 4, 6, 8)
unset($value); // 最后取消掉引用

// 将多个值保存在匿名数组中
$fruits['red'][]='strawberry';$fruits['red'][]='apple';

// 将关联数组，根据 键名 拆成 一个个的变量！
extract($var_array, EXTR_PREFIX_SAME, "ex"); //如果前面有定义过此变量，则变量名加前缀　ex

// list构造器　将数组里面的值分别指定给单独变量
list($b,$c,$d) =  array('apple','orange','card');echo $b,$c,$d; //apple orange card

// 合并两个数组
array_merge($arr1,$arr2);//$arr2 会覆盖同名键的值

// 检查数组中是否存在某个键
array_key_exists('key',$array);//key存在就返回true,不考虑对应的值isset($array['key']);/*在array 中的键存在，且不为null*/

// 检查数组中是否包含某个值
in_array('value',$array);//存在就返回ture

// 将数组按键排序
ksort($array);

// 计算两个数组的并集
$union = array_unique(array_merge($A,$b));

// 使用回调函数过滤　array 中的值
$ar = array("hello", null, "world");
print(implode(',', $ar));
worldprint(implode(',', array_filter($ar, function($v){ return $v !== null; }))); // hello,world

// 数组合并为字符串
join(',',$arr);//返回以 , 分割的字符串implode('-',array('a','b','c'));

// 一维数字去重
$aa=array("apple","banana","pear","apple","wail","watermalon"); 
$bb=array_unique($aa); 
print_r($bb); //Array ( [0] => apple [1] => banana [2] => pear [4] => wail [5] => watermalon)

// 二维数组去重,因为某一键名的值不能重复，删除重复项
$aa = array(
    array('id' => 123, 'name' => '张三'),
    array('id' => 123, 'name' => '李四'),
    array('id' => 124, 'name' => '王五'),
    array('id' => 125, 'name' => '赵六'),
    array('id' => 126, 'name' => '赵六')
);//需求，id 不能重复
function assoc_unique($arr, $key){
    $tmp_arr = array();
    foreach($arr as $k => $v){
        //搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
        if(in_array($v[$key], $tmp_arr)){
            unset($arr[$k]);
        }else {
            $tmp_arr[] = $v[$key];
       }
    }
    sort($arr); //sort函数对数组进行排序
    return $arr;
}
$key = 'id';
assoc_unique(&$aa, $key);
print_r($aa);//Array ( [0] => Array ( [id] => 123 [name] => 张三 ) [1] => Array ( [id] => 124 [name] => 王五 ) [2] => Array ( [id] => 125 [name] => 赵六 ) [3] => Array ( [id] => 126 [name] => 赵六 ) )

// 二维数组去重,因内部的一维数组不能完全相同，而删除重复项
$aa = array(
    array('id' => 123, 'name' => '张三'),
    array('id' => 123, 'name' => '李四'),
    array('id' => 124, 'name' => '王五'),
    array('id' => 123, 'name' => '李四'),
    array('id' => 126, 'name' => '赵六')
);
function array_unique_fb($array2D){
    foreach ($array2D as $v){
        $v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
        $temp[] = $v;
    }
    $temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v){
        $temp[$k] = explode(",",$v); //再将拆开的数组重新组装
    }
    return $temp;
}
$bb=array_unique_fb($aa);
print_r($bb); //Array ( [0] => Array ( [0] => 123 [1] => 张三 ) [1] => Array ( [0] => 123 [1] => 李四 ) [2] => Array ( [0] => 124 [1] => 王五 ) [4] => Array ( [0] => 126 [1] => 赵六 ) )
```

# 下载文件
前端代码
```javascript
<a href="doDownload.php?filename=1.jpg">通过程序下载1.jpg</a><br />
<a href="doDownload.php?filename=../upload/nv.jpg">下载nv.jpg</a>
```
后端代码
```php
<?php
$filename=$_GET['filename'];
header('content-disposition:attachment;filename='.basename($filename));
header('content-length:'.filesize($filename));readfile($filename);
```

# 脚本执行完注册函数
```php
<?php
register_shutdown_function(array('core', 'handleShutdown'));
```
当我们的脚本执行完成或意外死掉导致PHP执行即将关闭时,我们的这个函数将会 被调用.所以,我们可以使用在脚本开始处设置一个变量为false,然后在脚本末尾将之设置为true的方法,让PHP关闭回调函数检查脚本完成与否. 如果我们的变量仍旧是false,我们就知道脚本的最后一行没有执行,因此它肯定在程序执行到某处死掉了
http://www.blogdaren.com/post-2030.html


# 设置异常处理函数
```php
<?php
set_exception_handler(array('core', 'handleException'));
```

# 设置错误处理函数
```php
<?php
set_error_handler(array('core', 'handleError'));
```
