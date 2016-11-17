[TOC]
# 类内部的动态成员变量
```
class TestClass{
      function TestClass(){
            $this->addAttr = "testtest";
      }
      function testAddAttr(){
           echo $this->addAttr;
     }
}
$a = new TestClass();
$a->TestClass();
$a->testAddAttr();    // testtest
```

说明：addAttr我们动态给类对象的一个变量，该变量只能在类内部使用
## self parent
`self::$name;`访问本类静态属性 ,`parent::$name`用于访问父类定义的静态属性
`self::func();`访问本类静态方法,`parent::func();`用于访问父类定义的静态方法
`self::CONST_DATA;`访问本类用`const CONST_DATA;`定义的常量,`parent::CONST_DATA;`访问父类定义的常量

## static
static 用于标示一个成员变量|成员方法是静态的,既可以用对象访问,也可以用类名访问。静态属性的值是所有该类的对象共用的。
类内部访问静态变量：`self::$name` ,静态方法：`self::func()`

子类访问父类的静态变量:`parent::$name` 静态方法：`parent::func();`

类外部访问静态变量：`Car::$speed;`,静态方法：`Car::speedUp();`

静态方法只能访问静态属性,不能使用$this

## new static()
在类里面生成本类的对象,子类继承该方法，使用该方法new出来的对象是子类,而不是实现了create的父类,这种技术就是迟静态绑定
```

abstract class DomainObject{
    	public function create(){
    	    	return new static();
    	}
}
class User extends DomainObject{}
class Document extends DomainObject{}
print_r(Document::create());	//Document Object ( )
print_r(User::create());	//User Object  ( )
```

## 继承 extends
在子类中使用父类的方法`parent::func($param);`,子类重写父类中的方法时常用,如重写构造函数`parent::__construct();`

## 对象相等
`==`只要两个对象属性一致就相等,`===`必须为同一个对象才相等

## 对象克隆
`$b = $a`是赋值引用,$a与$b指向同一个对象
`$b = clone $a;` 是克隆一个$a对象,$a 与 $b 分别指向不同对象(内存地址)

## 对象类型限定
`function write(ShopProduct  $shopProduct)` 限定参数只能是ShopProduct类,或是它的子类;若ShopProduct是接口,则是限定参数是实现了该接口的类

## ::class获取类的完全限定名称
```
namespace NS;
    class ClassName {    }
    echo ClassName::class;  // NS\ClassName
```
## 魔术方法
```php
class Test{
    public $params = [];
    public function __construct(){  //当对象被创建时调用 }
    public function __destruct(){ //对象被销毁时调用 }
    //当对象设置不存在的属性时,使用一个$params变量将设置的值保存起来
    public function __set($key,$value){
        $this->params[$key] = $value;   //$test->name = '曹开彦'; $key 对应 name , $value 对应 '曹开彦'
    }
    public function __get($key){
        return $this->params[$key];     // echo $test->name; 时调用,$key 对应 name
    }
    //在对象调用不存在的方法时执行
    public function __call($func,$params){
        var_dump($func,$params);   //$test->show('caokaiyan','1995');  $func 对应'show',$params = ['caokaiyan','1995'];
    }
    static public function __callStatic($func,$params){ //跟 __call 类似,给静态方法提供的}
    public function __toString(){ return __DIR__; //把一个对象当做字符串使用时执行 }
    //当对象被当做一个函数使用时调用,如$test('caokaiyan','21'); $params存的是函数参数['caokaiyan','21']
    public function __invoke($params){ var_dump($params);} // $test($params); 时调用，将类作为函数使用，调用__invoke,输出$params
    __isset 对不可访问或不存在的属性调用isset()或empty()时被调用
    __unset对不可访问或不存在的属性进行unset时被调用
    //__sleep当使用serialize时被调用，当你不需要保存大对象的所有数据时很有用
    //__wakeup当使用unserialize时被调用，可用于做些对象的初始化操作
    //__clone 进行对象clone时被调用，用来调整对象的克隆行为
    //__set_state 当调用var_export()导出类时，此静态方法被调用。用__set_state的返回值做为var_export的返回值。
    //__debuginfo 当调用var_dump()打印对象时被调用（当你不想打印所有属性）适用于PHP5.6版本
}
```

# 面向对象和面向过程的核心区别？
区别在于如何分配职责。
过程式代码:表现为一系列命令和方法的连续调用。控制代码根据不同的条件执行不同的职责。这中自顶向下的控制方式导致了重复和相互依赖的代码遍布整个项目。
面向对象:则是将职责从客户端代码移动到专门的对象中，尽量减少相互依赖！
# 面向对象的核心:抽象
封装（encapsulation）：在类的接口后面隐藏实现和数据。
多态（polymorphism）：使用一个共同的父类，允许在运行时透明地替换特定的子类。
面向对象可以提高程序的封装性，可重用性，可维护性，但仅仅是可以，根本还是取决于编程和设计人员对程序的深入思考。
在面向对象开发中，专注于特定任务，忽略外界上下文是一个很重要的原则！

## 抽象类
为什么使用抽象类？
1，我觉得是为了提取各个子类的功能，使之抽象化，方便调用！
2，屏蔽了子类的区别，只关注子类的共同功能，并且不关心功能的具体实现！
```
abstract class Father{
    abstract public function say();
}
class Son1 extends Father{ public function say(){ echo "son1\n";}}
class Son2 extends Father{ public function say(){ echo "son2\n";}}
class Son_say{
    public function ask_son_say(Father $father){
        	 //参数 ，我们使用的是抽象类，只要是该抽象类的子类，都有 say 方法，当然就有了各自的实现
        	 $father->say();
    }
}
$son1 = new Son1();
$son2 = new Son2();
$say  = new Son_say();
$say->ask_son_say($son1);
$say->ask_son_say($son2);
```
## 接口
1,是功能的封装抽象，我们只关注功能，不关心功能的实现，只要是继承了该接口的类，就应该具有接口的功能！
2,也就是说，你只要知道了一个对象的类型(继承了什么父类，实现了什么接口)，就知道它能做什么！
3,接口和抽象类的区别在于：抽象类关注的是其子类的功能和共性的抽象，而接口更关注的是功能,实现该接口的类就需要有该功能,它不在意类的继承关系
```
interface Chargeable{    public function getPrice();}
class ShopProduct implements Chargeable{
    public function getPrice(){
        return 5;
    }
}
class Test{
    static public function echo_price(Chargeable $item){	//这里限定类型是 接口，只要传递进来的类实现了该接口，都是合法的
        echo $item->getPrice();
    }
}
Test::echo_price(new ShopProduct());	// 5
```

# 对象语法参考
```
class Myclass{
    private $id=0;//私有属性
    protected $name;
    const SUCCESS="hehe";//类常量
    static private $instance=NULL;//静态变量
    public function __construct(){
        echo "这是标准php5构造方法";
    }
    public function __destruct(){
        echo "这是php5标准析构方法";
    }
    public function getId(){
        echo self::$instance;//类内部直接使用静态变量
        return $this->id;
    }
    public static function hellostatic(){
        echo '这是类 的静态方法 ';
    }
    final function getBaseClassName(){
        echo "final修饰，这个方法不允许被子类重写";
        return __CLASS__; //返回本类的类名
    }
    function __clone(){
        echo "对象已经被克隆";
    }
}
$obj = new Myclass();
//克隆一个新对象（有独立的内存）
$obj_copy= clone $obj;
echo Myclass::SUCCESS;//直接使用类常量
Myclass::hellostatic();//直接使用静态方法
echo Myclass::$instance;//直接使用类静态变量
final class FinalClass(){
    function display(){
        echo 'final修饰，这个类是不允许被继承的';
    }
}
interface Display{
    function display(){
    }
}
class Circle implements Display{
    function display(){
        echo "我实现接口里面的方法";
    }
}
if($obj instanceof Myclass){
    echo "$obj 是类  Myclass 的实例";
}
abstract class MyBaseClass(){
    function display(){
        echo "抽象类禁止被实例化，只能被继承";
    }
    abstract function show(){
        //抽象类，没有任何功能，只能被继承
    }
}
```

### 类反射
* 为了在不看类内部实现的情况下，深入了解一个类！
```
class A{
    const A = 'i am const A';
    private $a = "aaa";
    public function hehe(){
        echo "heheh";
    }
}
$prod_class = new ReflectionClass('A');
Reflection::export($prod_class);
```
### 静态属性和静态方法
```
class StaticExample{
    static public $num = 10;
    public function func(){
        echo self::$num."static function ";	 //在类内部使用 静态变量
    }
}
echo StaticExample::$num."\n";//在外部访问静态属性
StaticExample::func();//在外部调用静态方法
```
* 为何要使用静态变量和静态方法？
1，在程序任意可以访问到类的地方都可以使用，不用为了获取一个简单的功能而实例化一个对象！
2，由该类new出来的对象之间，可以共享一些东西！
* 静态方法中，$this伪变量不允许使用。可以使用self，parent，static在内部调用静态方法与属性。
```
class Car {
    private static $speed = 10;
    public static function getSpeed() {
        return self::$speed;
    }
    public static function speedUp() {
        return self::$speed+=10;
    }
}
class BigCar extends Car {
    public static function start() {
        parent::speedUp();
    }
}
BigCar::start();
echo BigCar::getSpeed();
```

### 类常量：为了一个只读属性！
```
class ShopProduct{
    const   AVAILBLE    =   0;    //定义一个常量
}
print ShopProduct :: AVAILBLE ;    //在外部访问
```
### 类的自动加载
```
<?php
spl_autoload_register("autoload1");
spl_autoloda_register("autoload2");
function autoload1($class){
    require  __DIR__.$class.'.php'; //如果在本文件中，使用的函数或者类没有定义，就尝试引入这个文件，$class 为new 的类名(带命名空间的)
}
function autoload2($class){
    require  __DIR__.'/framework/'.$class.'.php';
}
```

### 命名空间
* 原来的 php 代码都是在同一个空间下，不能有重名的类，和方法，属性。命名空间起一个隔离的作用。
* 使用完整的"命名空间\函数名"调用函数,命名空间\类名调用类！
```
$res = App\model\query($sql);
$ar  = new App\model\ActiveRecord();
```
* use
```
use function App\model\query;
use App\model\ActiveRecord;
$res = query($sql);
$ar  = new ActiveRecord();
```
* as 取别名
```
use function App\model\query as q;
use App\model\ActiveRecord as AR;
$res = q($sql);
$res = new AR();
```

# 子类继承父类
* 构造函数要显式调用 `parent::__construct()...`
# 对象之间的相互调用关系：聚合 组合
* 聚合：类A和B，A通过自己的method获取到B的一个实例，从而能够使用B的功能，称为A聚合B！
* 组合：类A完全拥有B，A负责实例化B,常用于A是唯一需要使用B的类的场景
* 使用建议：
试想下：A对象消亡时，B是否还应该存在？如果B不应该存在，使用组合，如果存在，就应该使用聚合！
       组合会使对象之间出现紧耦合！
       聚合的问题：B对象被多个对象聚合，任何一个对象对B对象状态的改变都可能会影响到其他对象，要多考虑B的代码重用性！
