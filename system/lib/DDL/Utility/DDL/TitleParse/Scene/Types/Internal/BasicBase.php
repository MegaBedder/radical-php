<?php
namespace Utility\DDL\TitleParse\Scene\Types\Internal;

use Utility\DDL\TitleParse\Internal\TitleParseBase;

abstract class BasicBase extends TitleParseBase {
	const DELIMITER = ' ';
	protected $parts = array();
	
	static function CleanString($str) {
		$str = implode ( ' ', $str );
		return trim ( $str );
	}
	
	protected function Split($string){
		return explode(static::DELIMITER,$string);
	}
	
	function __construct($release){
		parent::__construct($release);
		$this->parts = $this->Split($release);
		$this->Parse();
	}
	
	protected function extractPart($p=0,$peek=false){
		if($p<0){
			$p = (count($this->parts) + $p);
		}
		if(!isset($this->parts[$p])){
			return null;
		}
		$r = $this->parts[$p];
		if(!$peek){
			unset($this->parts[$p]);
		}
		$this->parts = array_values($this->parts);
		return $r;
	}
}