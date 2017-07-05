<?php
class Father{
    static function create(){
        return new self();
    }
}
class Son extends Father{
}
class Girl extends Father{
}

var_dump(Son::create());
var_dump(Girl::create());
