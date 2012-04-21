<?php
namespace Web\Session\Authentication;

use Web\Session\ModuleBase;

use Web\Session\Handler\Internal\ISessionHandler;

class Http extends ModuleBase implements IAuthenticator {
	function Authenticate(){
		$headers = \Web\PageHandler::$stack->top()->headers;
		$headers->Status(401);
		$headers->Add('WWW-Authenticate','Basic realm="Site Login"');
		echo 'Text to send if user hits Cancel button';
	}
	function AuthenticationError($msg){
		die('Login Failed: '.$msg);
		//@todo complete
	}
	function Init(ISessionHandler $handler){
		if(isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_PW']){
			$username = $_SERVER['PHP_AUTH_USER'];
			$password = $_SERVER['PHP_AUTH_PW'];
			
			$success = $handler->Login($username,$password);
			
			if(!$success){
				return $this->AuthenticationError();
			}
		}
	}
}