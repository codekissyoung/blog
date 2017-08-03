<?php
class RequestHelper{}

abstract class ProcessRequest {
	abstract function process( RequestHelper $req );
}

class MainProcess extends ProcessRequest {
	function process( RequestHelper $req ){
		print __CLASS__." : doing something userful with request ! \n";
	}
}

abstract class DecorateProcess extends ProcessRequest{
	protected $processrequest;
	function __construct( ProcessRequest $pr ){
		$this -> processrequest = $pr;
	}
}

class LogRequest extends DecorateProcess{
	function process ( RequestHelper $req ) {
		print __CLASS__." : logging data \n";
		$this -> processrequest -> process( $req );
	}
}

class AuthRequest extends DecorateProcess{
	
	function process ( RequestHelper $req ) {
		print __CLASS__." : authenticating data \n";
		$this -> processrequest -> process( $req );
	}
}

class StrucRequest extends DecorateProcess{
	function process ( RequestHelper $req ) {
		print __CLASS__." : struc request data \n";
		$this -> processrequest -> process( $req );
	}
}

$process = new AuthRequest( new StrucRequest( new LogRequest( new MainProcess() )) );
$process -> process( new RequestHelper() );















