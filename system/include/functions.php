<?php
use Web\IToURL;

function oneof($object, $class){
	if(is_object($object)) return $object instanceof $class;
	if(is_string($object)){
		if(is_object($class)) $class=get_class($class);

		if(class_exists($class)) return is_subclass_of($object, $class) || $object==$class;
		if(interface_exists($class)) {
			if(!class_exists($object)) return false;
			
			$reflect = new ReflectionClass($object);
			return $reflect->implementsInterface($class);
		}

	}
	return false;
}
function _U($url,$param=null){
	return (string)\Utility\Net\URL::fromRequest(U($url,$param));
}
function u($url,$param=null) {
	global $BASEPATH;
	
	$length = strlen($_SERVER['DOCUMENT_ROOT']);
	$base = substr($BASEPATH,$length);
	
	//Convert to URL
	if (is_object ( $url ) && $url instanceof IToURL) {
		$url = $url->toURL($param);
	}
	
	if(substr($url,0,5) == 'http:')
		return $url;
	
	//Return
	return $base . ltrim ( $url, '/' );
}
/*function r($resource_id,$filters=array()) {
	$url = CDN('resource/' . $resource_id);
	if(!$filters){
		return $url;
	}
	if(is_object($filters)){
		$filters = array($filters);
	}
	foreach($filters as $k=>$f){
		if(!is_object($f)){
			unset($filters[$k]);
		}
	}
	if(!$filters){
		return $url;
	}
	$url .= '?gd=1&filters=';
	$data = array();
	foreach($filters as $f){
		$class = get_class($f);
		$class = substr($class,strrpos($class,'\\')+1);
		$data[$class] = $f->toData();
	}
	$url .= urlencode(json_encode($data));
	return $url;
}*/
function array_sort($array, $on, $order = 'SORT_DESC') {
	$new_array = array ();
	$sortable_array = array ();
	
	if (count ( $array ) > 0) {
		foreach ( $array as $k => $v ) {
			if (is_array ( $v )) {
				foreach ( $v as $k2 => $v2 ) {
					if ($k2 == $on) {
						$sortable_array [$k] = $v2;
					}
				}
			} else {
				$sortable_array [$k] = $v;
			}
		}
		
		switch ($order) {
			case 'SORT_ASC' :
				asort ( $sortable_array );
				break;
			case 'SORT_DESC' :
				arsort ( $sortable_array );
				break;
		}
		
		foreach ( $sortable_array as $k => $v ) {
			$new_array [] = $array [$k];
		}
	}
	return $new_array;
} 
function h($string){
	return htmlspecialchars($string,ENT_COMPAT);//,'UTF-8'
}
if(!function_exists('mysqli_fetch_all')){
	function mysqli_fetch_all($res,$resulttype = MYSQLI_NUM){
		$ret = array();
		while($row = mysqli_fetch_array($res,$resulttype)){
			$ret[] = $row;
		}
		return $ret;
	}
}