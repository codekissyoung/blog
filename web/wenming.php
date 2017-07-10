<?php
abstract class Unit {
	abstract function addUnit( Unit $unit );
	abstract function removeUnit( Unit $unit );
	abstract function bombardStrength();
}

// 射手
class Archer extends Unit {
	function bombardStrength() {
		return 4;
	}
}

// 激光炮
class LaserCannonUnit extends Unit {
	function bombardStrength(){
		return 44;
	}
}

class UnitException extends Exception {}

class Army extends Unit {
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
		return $ret;
	}

}













