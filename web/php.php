<?php
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

$prod_class = new ReflectionClass('Son');
// Reflection::export($prod_class);

$methods = $prod_class -> getMethods();

foreach ($methods as $method) {
    print methodData($method);
    print "\n--------\n";
}

function methodData(ReflectionMethod $method){
    $details = "";
    $name = $method -> getName();
    if($method -> isUserDefined()){
        $details .= "$name is user defined\n";
    }
    if($method -> isPublic()){
        $details .= "$name is public！\n";
    }
    return $details;
}










