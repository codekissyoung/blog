<?php
namespace A;
class Father{
    public function show(){
        echo static::data();
    }
}
class Son extends Father{
    public $pri = 'pri';
    public function data(){
        return "Son data {$this -> pri}\n";
    }
}
class Girl extends Father{
    public function data(){
        return "Girl data\n";
    }
}

$s = new Son();
$s -> show(); // Son data pri , 因为执行者是 Son ,所以 static 指向的是Son


echo Son::class;