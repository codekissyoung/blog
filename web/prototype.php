<?php
class Sea{
	private $navigability = 0;
	function __construct( $navigability ){
		$this -> navigability = $navigability;
	}
	
}
class EarthSea extends Sea {}
class MarsSea extends Sea {}

class Plains {}
class EarthPlains extends Plains{}
class MarsPlains extends Plains{}

class Forest{}
class EarthForest extends Forest {}
class MarsForest extends Forest {}

class TerrainFactory {
	
	private $sea;
	private $forest;
	private $plains;

	function __construct(Sea $sea , Plains $plains ,Forest $forest){
		$this -> sea = $sea;
		$this -> plains = $plains;
		$this -> forest = $forest;
	}

	function getSea(){
		return clone $this -> sea;
	}

	function getPlains(){
		return clone $this -> plains;
	}

	function getForest() {
		return clone $this -> forest;
	}
	
}

$factory = new TerrainFactory( new EarthSea( -1 ) ,new EarthPlains() ,new EarthForest() );
print_r( $factory -> getSea() );
print_r( $factory -> getPlains() );
print_r( $factory -> getForest() );


class Contained{}

// 浅复制 : $obj_copy = clone $object; 假如被复制对象里面有属性也是对象，也只是复制该属性，也就是一个引用，而不会复制对象本身
// 深复制 : 通过 __clone 魔术方法，指定在clone的时候，将对象内的对象也一并复制

class Container {
	public $con;
	function __construct(){
		$this -> con = new Contained();
	}
	// 深复制
	function __clone(){
		$this -> con = clone $this -> contained;
	}
}

























