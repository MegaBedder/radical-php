<?php
namespace Web\Page\Admin;

use Web\Page\Handler\HTMLPageBase;
use Web\Page\Handler;

abstract class AdminModuleBase extends HTMLPageBase implements Modules\IAdminModule {
	function getName(){
		return $this->getModuleName();
	}
	function getModuleName(){
		$c = ltrim(get_called_class(),'\\');
		$c = substr($c,strlen(Constants::CLASS_PATH));
		return $c;
	}
	function getSubmodules(){
		return array();
	}
	function toURL(){
		return '/admin/'.$this->getModuleName();
	}
	function __toString(){
		return $this->getName();
	}
	static function createLink(){
		return new static();
	}
}