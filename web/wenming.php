<?php
class UnitException extends Exception {/*{{{*/

}/*}}}*/

abstract class Unit {/*{{{*/
	function getComposite(){
		return null;
	}

	function addUnit ( Unit $unit ) {
		throw new UnitException( get_class( $this )." is a leaf ");
	}
	function removeUnit( Unit $unit ){
		throw new UnitException( get_class( $this )." is a leaf " );
	}
	abstract function bombardStrength();
}/*}}}*/

abstract class CompositeUnit extends Unit {/*{{{*/
	private $units = [];

	function getComposite(){
		return $this;
	}

	protected function units(){
		return $this -> units;
	}

	function removeUnit ( Unit $unit ) {
		$this -> units = array_udiff( $this -> units , array($unit) , function ($a ,$b){ return ($a === $b)?0:1;});
	}

	function addUnit( Unit $unit ){
		if( in_array($unit ,$this -> units,true) ){
			return;
		}
		$this -> units[] = $unit;
	}
}/*}}}*/

// 射手
class Archer extends Unit {/*{{{*/
	function bombardStrength() {
		return 4;
	}

}/*}}}*/

// 激光炮
class LaserCannonUnit extends Unit {/*{{{*/
	function bombardStrength(){
		return 44;
	}
}/*}}}*/

// 军队 : 由军队 / 射手 / 激光炮组成
class Army extends Unit {/*{{{*/
	private $units = [];
	private $armies = [];

	function addUnit( Unit $unit ){
		if( in_array( $unit , $this -> units , true ) ){
			return;
		}
		$this -> units[] = $unit;
	}
	
	function removeUnit( Unit $unit ){
		$this -> units = array_udiff( $this -> units , [$unit] , function($a,$b){ return ($a == $b) ? 0 : 1; } );
	}

	function addArmy (Army $army){
		array_push( $this -> armies , $army );
	}

	function bombardStrength(){
		$ret = 0;
		foreach( $this -> units as $unit ){
			$ret += $unit -> bombardStrength();
		}
		foreach( $this -> armies as $army){
			$ret += $army -> bombardStrength();
		}
		return $ret;
	}

}/*}}}*/


// army 对象
$main_army = new Army();
$main_army -> addUnit( new Archer() );
$main_army -> addUnit( new LaserCannonUnit() );

// 另一个 army对象
$sub_army = new Army();
$sub_army -> addUnit( new Archer() );
$sub_army -> addUnit( new Archer() );
$sub_army -> addUnit( new Archer() );

// 将一部分军队加入到另一部分军队中
$main_army -> addArmy( $sub_army );

print "攻击强度: {$main_army -> bombardStrength() } \n";









