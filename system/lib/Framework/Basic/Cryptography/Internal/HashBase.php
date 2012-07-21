<?php
namespace Basic\Cryptography\Internal;

use Basic\Cryptography\HashTypes\IOneWayHash;

abstract class HashBase {
	static function Encode($text,$key = null){
		return static::Hash($text);
	}
	static function Compare($password,$hash){
		return ($password == $hash);
	}
}