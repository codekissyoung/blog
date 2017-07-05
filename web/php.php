<?php 
class Product{
    public $title;
    static public $company = "彦游天下网络技术有限公司";
    
    function __construct($title){
        $this -> title = $title;
    }
    
    static public function show_company(){
        print "公司:".Product::$company;
    }
    
    function show(){
        print "产品名:$this->title";
        Product::show_company();
    }

}

class Apple extends Product{
    private $price;
    function __construct($title,$price){
        parent::__construct($title);
        $this -> price = $price;
    }
}

$a = new Apple('富士山',10);
$a -> show();


