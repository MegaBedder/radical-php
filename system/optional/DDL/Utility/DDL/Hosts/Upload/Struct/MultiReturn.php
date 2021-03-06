<?php
namespace Utility\DDL\Hosts\Upload\Struct;

class MultiReturn {
	public $ch;
	private $callback;
	public $file;
	
	function __construct($ch,$callback,$file=null){
		$this->ch = $ch;
		$this->callback = $callback;
		$this->file = $file;
	}
	
	function callback($page){
		$c = $this->callback;
		if(is_array($c)){
			return call_user_func($c,$page,$this);
		}else{
			return $c($page,$this);
		}
	}
	
	function cH(){
		return $this->ch;
	}
}