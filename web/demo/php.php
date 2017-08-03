<?php
abstract class ParamHandler {
	protected $source;
	protected $params = [];
	
	function __construct($source){
		$this -> source = $source;
	}
	
	function addParam($key,$value){
		$this -> params[$key] = $value;
	}
	
	function getAllParams(){
		return $this -> params;
	}
	
	static function getInstance($filename){
		if(preg_match("/\.xml$/",$filename)){
			return new XmlParamHandler($filename);
		}
		return new TextParamHandler($filename);
	}
	
	abstract function write();
	abstract function read();
}

class XmlParamHandler extends ParamHandler{
	function write(){
		echo "write xml";
	}
	function read(){
		echo "read xml";
	}
}

class TextParamHandler extends ParamHandler {
	function write(){
		echo "write text";
	}
	function read(){
		echo "read text";
	}
}

$test = ParamHandler::getInstance('./params.xml');
$test -> addParam('key1','value1');
$test -> addParam('key2','value2');
$test -> write();

$t = ParamHandler::getInstance('./params.txt');
$t -> addParam('key1','value1');
$t -> addParam('key2','value2');
$t -> read();






















