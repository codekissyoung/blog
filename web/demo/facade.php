<?php
function getProductFileLines($file){
	return file($file);
}

function getProductObjectFromId($id,$productname){
	return new Product($id,$productname);
}

function getNameFromLine($line){
	if(preg_match("/.*-(.*)\s\d+/",$line,$array)){
		return str_replace('_',' ',$array[1]);
	}
	return '';
}

function getIDFromLine($line){
	if(preg_match("/^(\d{1,3})-/",$line,$array)){
		return $array[1];
	}
	return -1;
}

class Product{
	public $id;
	public $name;
	function __construct($id,$name){
		$this -> id = $id;
		$this -> name = $name;
	}
}

// 外观模式封装
class ProductFacade{
	private $products = [];
	private $file;

	function __construct($file){
		$this -> file = $file;
		$this -> compile();
	}

	private function compile(){
		$lines = getProductFileLines($this -> file);
		foreach($lines as $line){
			$id = getIDFromLine($line);
			$name = getNameFromLine($line);
			$this -> products[$id] = getProductObjectFromID($id,$name);
		}
	}

	function getProducts(){
		return $this -> products;
	}

	function getProduct($id){
		return $this -> products[$id];
	}
}

$lines = getProductFileLines('test_facade');
$objects = [];
foreach($lines as $line){
	$id = getIDFromLine($line);
	$name = getNameFromLine($line);
	$objects[$id] = getProductObjectFromID($id,$name);
}
var_dump($objects);

// 使用外观模式
$facade = new ProductFacade("test_facade");
$product = $facade -> getProduct('234');
var_dump($product);










