<?php
class Preferences {
	private $props = [];
	private static $instance;

	private function __construct(){}

	public function setProperty ( $key , $val ) {
		$this -> props[$key] = $val;
	}

	public function getProperty( $key ){
		return $this -> props[$key];
	}
	
	public static function getInstance(){
		if( empty( self::$instance ) ){
			self::$instance = new self();
		}
		return self::$instance;
	}
}

$pref = Preferences :: getInstance();
$pref -> setProperty("name","codekissyoung");

unset($pref);
$pref2 = Preferences :: getInstance();
print $pref2 -> getProperty("name")."\n";




