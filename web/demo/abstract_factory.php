<?php
abstract class CommsManager {
	const APPT = 1;
	const TTD = 2;
	const CONTACT = 3;
	
	abstract function getHeaderText();

//	abstract function getApptEncoder();
//	abstract function getTtdEncoder();
//	abstract function getContactEncoder();
	
	// 抽象工厂
	abstract function make( $type );
	abstract function getFooterText();

}

class BloggsCommsManager extends CommsManager {

	function getHeaderText(){
		return "BloggsCal header";
	}
/*
	function getApptEncoder(){
		return new BloggsApptEncoder();
	}

	function getTtdEncoder(){
		return new BloggsTtdEncoder();
	}

	function getContactEncoder(){
		return new BloggsContactEncoder();
	}
	
*/
	function make ( $type ) {
		switch($type){
			case self::APPT:
				return new BloggsApptEncoder();
				break;
			case self::TTD:
				return new BloggsTtdEncoder();
				break;
			case self::CONTACT:
				return new BloggsContactEncoder();
				break;
		}
	}

	function getFooterText(){
		return "BloggsCal footer \n";
	}
}

















