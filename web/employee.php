<?php
abstract class Employee {
	protected $name;
	private static $types = array( "minion",'cluedup','WellConnected');

	static function recruit( $name ){
		$num = rand( 1,count(self::$types) ) - 1;
		$class = self::$types[$num];
		return new $class( $name );
	}

	function __construct($name){
		$this -> name = $name;
	}

	abstract function fire();
}

class Minion extends Employee {
	function fire(){
		print "{$this -> name} : I 'll clear my desk \n";
	}
}

class WellConnected extends Employee {
	function fire(){
		print "{$this -> name} : I 'll clear my desk \n";
	}
}

class CluedUp extends Employee {
	function fire(){
		print "{$this -> name} : I 'll clear my lawyer \n";
	}
}

class NastyBoss {
	private $employees = [];
	function addEmployee( Employee $employee ){
		// $this -> employees[] = new Minion($employee_name); // 直接在对象里面 new 一个新对象，非常不可取
		$this -> employees[] = $employee;
	}
	function projectFails(){
		if( count($this -> employees) > 0 ){
			$emp = array_pop( $this -> employees );
			$emp -> fire();
		}
	}
}

$boss = new NastyBoss();
$boss -> addEmployee( Employee::recruit("harry") );
$boss -> addEmployee( Employee::recruit("bob") );
$boss -> addEmployee( Employee::recruit("mary") );
$boss -> projectFails();
$boss -> projectFails();
$boss -> projectFails();












