<?php
namespace Utility\Cache;

class FunctionCache extends GlobalCache {
	const POOL_NAME = 'function';
	protected static $cache = array();
	
	static function call($callback,$ttl,$file,$line,$cache='Memory'){
		$key = $file.':'.$line;
		$cache = static::Get($cache);
		
		return $cache->CachedValue($key,$callback,$ttl);
	}
}