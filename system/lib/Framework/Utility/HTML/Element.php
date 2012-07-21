<?php
namespace Utility\HTML;

class Element extends SingleTag {
	public $inner;
	protected $singleClose = true;
	
	function __construct($tag,$attributes = array(),$inner = null){
		parent::__construct($tag,$attributes);
		$this->inner = $inner;
	}
	
	function __toString(){
		$ret = parent::__toString();
		if(!$this->inner && $this->singleClose){
			$ret = substr($ret,0,-1).'/>';
		}
		
		if($this->inner){
			if(is_array($this->inner)){
				foreach($this->inner as $v){
					$ret .= $v;
				}
			}else{
				$ret .= $this->inner;
			}
			if($this->singleClose)
				$ret .= '</'.$this->tag.'>';
		}
		
		if(!$this->singleClose)
			$ret .= '</'.$this->tag.'>';
		return $ret;
	}
}