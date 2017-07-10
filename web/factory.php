<?php
abstract class AppEncoder {/*{{{*/
	abstract function encode();
}/*}}}*/

class BloggsApptEncoder extends AppEncoder {/*{{{*/
	function encode(){
		return "Appointment data encoded in BloggsCal format \n";
	}
}/*}}}*/

class MegaApptEncoder extends AppEncoder {/*{{{*/
	function encode(){
		return "Appointment data encoded in MegaCal format \n";
	}
}/*}}}*/

// 对抽象工厂使用多态
abstract class CommsManager {/*{{{*/
	abstract function getHeaderText();
	abstract function getApptEncoder();
	abstract function getFooterText();
}/*}}}*/

class BloggsCommsManager extends CommsManager {
	function getHeaderText(){
		return "BloggsCal Header";
	}
	function getApptEncoder(){
		return new BloggsApptEncoder();
	}
	function getFooterText(){
		return "BloggsCal Footer";
	}
}

$blog = BloggsCommsManager::getApptEncoder();
print $blog -> encode();



