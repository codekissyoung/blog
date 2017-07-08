<?php
abstract class Lesson {/*{{{*/

	private $duration;
	private $costStrategy;

	function __construct($duration,CostStrategy $strategy){
		$this -> duration = $duration;
		$this -> costStrategy = $strategy;
	}

	function cost(){
		return $this -> costStrategy -> cost($this);
	}

	function chargeType(){
		return $this -> costStrategy -> chargeType();
	}

	function getDuration(){
		return $this -> duration;
	}

}/*}}}*/

class Lecture extends Lesson {/*{{{*/
	
}/*}}}*/

class Seminar extends Lesson {/*{{{*/
	
}/*}}}*/

abstract class CostStrategy {/*{{{*/
	abstract function cost( Lesson $lesson );
	abstract function chargeType();
}/*}}}*/

class TimedCostStrategy extends CostStrategy {/*{{{*/
	function cost(Lesson $lesson){
		return ( $lesson -> getDuration() * 5);
	}

	function chargeType(){
		return "hourly rate";
	}
}/*}}}*/

class FixedCostStrategy extends CostStrategy{/*{{{*/
	function cost ( Lesson $lesson ) {
		return 30;
	}

	function chargeType() {
		return "fixed rate";
	}
}/*}}}*/

class RegistrationMgr {/*{{{*/

	function register (Lesson $lesson){
		$notifier = Notifier::getNotifier();
		$notifier -> inform(" new lesson : cost ({$lesson -> cost()}) \n");
	}

}/*}}}*/

abstract class Notifier{/*{{{*/
	static function getNotifier() {
		if(rand(1,2) == 1){
			return new MailNotifier();
		}else{
			return new TextNotifier();
		}
	}

	abstract function inform($message);
}/*}}}*/

class MailNotifier extends Notifier{/*{{{*/
	function inform($message){
		print "MAIL notification : {$message} \n";
	}
}/*}}}*/

class TextNotifier extends Notifier{/*{{{*/
	function inform ( $message ){
		print "TeXT notification : {$message}\n";
	}
}/*}}}*/

$lessons[] = new Seminar( 4 ,new TimedCostStrategy() );
$lessons[] = new Lecture( 4 ,new FixedCostStrategy() );

foreach ( $lessons as $lesson ){
	print "lessson charge {$lesson -> cost()} \t";
	print "Charge type : {$lesson -> chargeType()}\n";
}

$mgr = new RegistrationMgr();

$mgr -> register($lessons[0]);
$mgr -> register($lessons[1]);













