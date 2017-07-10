<?php
abstract class CommsManager {
	const APPT = 1;
	const TTD = 2;
	const CONTACT = 3;
	
	abstract function getHeaderText();

	abstract function getApptEncoder();
	abstract function getTtdEncoder();
	abstract function getContactEncoder();
	
	abstract function getFooterText();

}

class BloggsCommsManager extends CommsManager {

	function getHeaderText(){
		return "BloggsCal header";
	}

	function getApptEncoder(){
		return new BloggsApptEncoder();
	}

	function getTtdEncoder(){
		return new BloggsTtdEncoder();
	}

	function getTtdEncoder(){
		return new BloggsTtdEncoder();
	}
	
	function getFooterText(){
		return "BloggsCal footer \n";
	}

}

















