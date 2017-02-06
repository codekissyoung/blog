# isset 是只要变量存在就true
null 就是不存在的意思，
```
$a = '';	var_dump(isset($a));	// true
$b = null;	var_dump(isset($b));	// false
var_dump(null);	 // NULL
```
# empty是只有变量不为空，才flase
`'',""，0，"0"，NULL，FALSE，array(),$var;` 和没有任何属性的对象在用 empty 判断时，都是空的，返回TURE；
```
class A{};
$a = new A;
if(!empty($var)) echo "not empty";
```
# 用 if 判断下面这些值时,就空对象是true
```
class A{}
if('')     echo "true";
if("")     echo "true";
if([])      echo "true";
if(new A)  echo "true";	 //true
if(null)  echo "true";
if(0)     echo "true";
if(0.0)	   echo "true";
if("0")	   echo "true";
```
# 静态变量 :驻留内存的变量

```
function a(){
    static $a = 1;
    echo $a;
    $a++;
}
a();//1
a();//2
```
# 常量：只读变量
`define("TEST",'codekissyoung');`定义常量
`bool defined(string constants_name);`判定常量是否被定义

# 可变变量:php是动态实时解析的语言
```php
//例子1
$a = "test";
$test = "i am the test";
function test（）{echo "i am function test!";}
echo $a; //test
echo $$a; // i am the test
$a(); //i am function test!
//例子2
foreach ($_POST as $key => $value) {
    $$key = $value;    //利用可变变量，use key name as variable name
｝
//例子3
// example.com?class=person&func=run
$class=$_GET['class'];
$func=$_GET['func'];
$obj=new $class();
$obj->$func();
```
# $_GET
```
http://www.dadishe.com/test/checkbox.php?a[]=b&a[]=c
array
    'a' =>
        array
            0 => string 'b' (length=1)
            1 => string 'c' (length=1)
```

# extensions
`$a = get_loaded_extensions();var_dump($a);`

# ini_get拿配置信息
echo ini_get("allow_url_fopen")?"支持":"不支持";
echo ini_get("file_uploads")?ini_get("upload_max_filesize"):"Disabled";
echo ini_get("max_execution_time");
