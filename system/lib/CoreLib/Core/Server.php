<?php
class Server {
	static function isProduction(){
		if(!isset($_SERVER['SERVER_ADDR'])) return true;
		return ($_SERVER['SERVER_ADDR'] !== '192.168.2.17' && $_SERVER['SERVER_ADDR'] !== '::1' && $_SERVER['SERVER_ADDR'] !== '127.0.0.1');
	}
	static function isCLI(){
		return (PHP_SAPI === 'cli');
	}
	static function isWindows(){
		return (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
	}
	static function getSiteRoot(){
		global $_SITEROOT;
		if(!isset($_SITEROOT))
			return '/';
		return $_SITEROOT;
	}
}