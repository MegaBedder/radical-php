<?php
namespace Basic\Cryptography;

use Basic\Cryptography\Internal\HashBase;

class Raw extends HashBase implements HashTypes\ITwoWayEncryption, HashTypes\IHash {
	static function Hash($text){
		return $text;
	}
	static function Decode($text,$key = null){
		return $text;
	}
}