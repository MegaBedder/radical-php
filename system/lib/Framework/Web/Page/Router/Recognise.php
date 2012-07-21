<?php
namespace Web\Page\Router;

use Utility\Net\URL;
use Web\Page\Request;

class Recognise extends \Core\Object {
	static $__dependencies = array('interface.Web.Page.Router.IPageRecognise','interface.Web.Page.API.IAPIModule');
	
	static function fromRequest(){
		$url = Request::getUrl();
		return static::fromURL($url);
	}
	
	static function fromURL(URL $url){
		$recognisers = \Core\Libraries::get('Web\\Page\\Router\\Recognisers\\*');
		foreach($recognisers as $class){
			if(\oneof($class,'Web\\Page\\Router\\IPageRecognise')){
				$r = $class::Recognise(clone $url);
				if($r){
					return $r;
				}
			}
		}
	}
}