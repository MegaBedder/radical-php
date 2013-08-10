<?php
namespace Web\Page\Handler;

use Web\Form\Security\Key;
class EventPageLink {
	const EVENT_HANDLER = '__rp_eventA';
	const EVENT_METHOD = '__rp_eventB';

	private $object;
	private $method;
	private $data;
	
	function __construct($object, $method, $data = null){
		$this->object = $object;
		$this->method = $method;
		$this->data = $data;
	}
	
	function __toString(){
		//Build security field
		$securityField = new Key(array($this,'Execute'));
		
		//Event details
		$qs = array();
		$qs[self::EVENT_HANDLER] = $securityField->Store(serialize($this->object));
		$qs[self::EVENT_METHOD] = base64_encode($securityField->Encrypt($this->method));
		$qs[Key::FIELD_NAME] = $securityField->getId();
		
		$str_qs = '?'.$_SERVER['QUERY_STRING']. ($_SERVER['QUERY_STRING']?'&':''). http_build_query($qs);
		
		return $str_qs;
	}
	
	function link($data = null){
		if($data == null){
			return (string)$this;
		}
		
		return new EventPageLink($this->object, $this->method, $data);
	}
	
	function Execute(){
		return $this->object->{$this->method}($this->data,Key::getData(false));
	}
}