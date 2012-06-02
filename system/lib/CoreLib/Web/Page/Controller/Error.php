<?php
namespace Web\Page\Controller;
use Web\Template;

use Web\Page\Handler;
use ErrorHandling\Errors\Internal\ErrorException;

class Error extends Page\Handler\HTMLPageBase {
	private $error;
	
	function __construct(ErrorException $error){
		$this->error = $error;
	}
	
	
	function GET(){
		return new Template('error',array('error'=>$this->error),'framework');
	}
	function POST(){
		return $this->GET();
	}
	
	static function fromURL(\Net\URL $url){
		$page = \Web\PageRecogniser\Recognise::fromURL($url);
		return new static($page);
	}
}